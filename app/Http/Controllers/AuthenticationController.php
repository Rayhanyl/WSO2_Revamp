<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ConfirmPasswordRequest;

class AuthenticationController extends Controller
{
    public function __construct(){
        $this->url = getUrlApi();
        $this->url_regis = getUrlRegis();
        $this->url_login = getUrlLogin();
        $this->url_email = getUrlEmail();
    }

    public function login(){
        return view('authentication.login');
    }

    public function authentication(Request $request){

        $username = base64_encode($request->username);
        $userinfo =  getUrlmail($this->url_email .'/pi-info/'. $username);
        $user = (array) $userinfo->basic;

        $validator = Validator::make($request->all(), [

            'username'              => 'required',
            'password'              => 'required',

        ],[
            'username' => 'Username form cannot be empty',
            'password' => 'The password form cannot be empty',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

                $payloads = [
                    'grant_type' => 'password',
                    'username' => $request->username,
                    'password' => $request->password,
                    'scope' => 'apim:admin apim:api_key apim:app_import_export apim:app_manage apim:store_settings apim:sub_alert_manage apim:sub_manage apim:subscribe openid apim:subscribe'
                ];

                $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Authorization' => 'Basic ckJpNTJRa1QyT0dTUjk5a0R6TTVPMGtRT253YToxdXY5UmI4UjBRZWZLaEVkSExDaDBNbUZUamNh',
                ])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url_login. '/oauth2/token');

                $data = json_decode($response->getBody()->getContents());

                if ($response->status() == 200)
                {
                    $request->session()->put('token', $data->access_token);
                    $request->session()->put('idtoken', $data->id_token);
                    $request->session()->put('firstname', $user['http://wso2.org/claims/givenname']);
                    $request->session()->put('lastname', $user['http://wso2.org/claims/lastname']);
                    $request->session()->put('phone', $user['http://wso2.org/claims/mobile']);
                    $request->session()->put('email', $user['http://wso2.org/claims/emailaddress']);
                    $request->session()->put('username', $user['http://wso2.org/claims/username']);

                    return redirect(route('application'))->with('success', 'Successful User Login!');
                }

                return redirect()->back()->with('warning', 'Wrong Username or Password');
        }
    }
    public function register(){
        return view('authentication.register');
    }

    public function authregister(Request $request){
        
        $validator = Validator::make($request->all(), [

            'firstname'             => 'required',
            'lastname'              => 'required',
            'userlogin'             => 'required|min:6',
            'phone'                 => 'required|numeric',
            'email'                 => 'required|email:rfc,dns',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            try {
                
                $payloads = [
                    'user' =>
                        [
                            'username' => $request->userlogin,
                            'realm' => 'PRIMARY',
                            'password' => $request->password,
                            'claims' =>
                            [
                                [
                                    "uri" => "http://wso2.org/claims/givenname",
                                    "value" => $request->firstname
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/emailaddress",
                                    "value" => $request->email
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/lastname",
                                    "value" => $request->lastname
                                ],
                                [
                                    "uri" => "http://wso2.org/claims/mobile",
                                    "value" => $request->phone
                                ]
                            ],
                        ],
                    'properties' =>
                        [
                            [
                                "key" => "callback",
                                "value" => "https://194.233.88.81:9443/authenticationendpoint/login.do"
                            ]
                        ]
                ];

                $response = Http::withBasicAuth('admin', 'admin')
                ->withOptions(['verify' => false])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url_regis. '/identity/user/v1.0/me');

                $data = json_decode($response->getBody()->getContents());

                if ($response->status() == '409') {
                    return back()->with('warning', $data->description);
                } else {
                    return redirect(route('login'))->with('success', 'Successful User Registration!');
                }

            } catch (\Exception $e) {
                dd($e);

                alert('Register user','Failed to perform user registration', 'error');
                return redirect()->back()->withInput($request->input());
            }

        }


    }
    public function forget(){
        return view('authentication.forgetpassword');
    }

    public function newpassword(Request $request)
    {
        $payloads = [
            'code' => $request->confirmation,
            'step' => '',
            'properties' => [],
        ];

        $response = Http::withOptions(['verify' => false])
        ->withBasicAuth('admin', 'admin')
        ->withHeaders([
            'Authorization' => 'Basic YWRtaW46YWRtaW4=',
            'Accept' => '*/*',
        ])
        ->withBody(json_encode($payloads),'application/json')
        ->post('https://194.233.88.81:9443/t/carbon.super/api/identity/recovery/v0.9/validate-code');
        $data = json_decode($response->getBody()->getContents());
        $status = $response->status();
        $confirmation = $request->confirmation;
        if ($response->status() == '400') {
            $invalid = $data->description;
            return view('authentication.newpassword',compact('status','data','confirmation','invalid'));
        } else {
            return view('authentication.newpassword',compact('status','data','confirmation'));
        }
    }

    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password'    => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{ 

            $payloads = [
                'key' => $request->confirmation,
                'password' => $request->password,
                'properties' => [],
            ];
    
            $response = Http::withOptions(['verify' => false])
            ->withBasicAuth('admin', 'admin')
            ->withHeaders([
                'Authorization' => 'Basic YWRtaW46YWRtaW4=',
                'Accept' => '*/*',
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post('https://194.233.88.81:9443/t/carbon.super/api/identity/recovery/v0.9/set-password');
            $data = json_decode($response->getBody()->getContents());
        
            if ($response->status() == '200') {
                return redirect(route ('login'))->with('success', 'Bershasil mereset password');
            }
    
            return back()->with('warning', $data->description);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('token');
        return redirect(route('login'));
    }
}
