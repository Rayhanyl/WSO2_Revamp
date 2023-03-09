<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();

    }

    public function profile() {
        return view('profile.index');
    }

    public function changepassword(Request $request)
    {
        try {

            $payloads = [
                'currentPassword' => $request->currentpassword,
                'newPassword' => $request->newpassword
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url. '/me/change-password');

            $data =json_decode($response->getBody()->getContents());
            if ($response->status() == '401') {
                $request->session()->forget('token');
                return redirect(route('loginpage'));
            }
            if ($response->status() == '400') {
                if ($data->code == '901451') {
                    return back()->with('warning', 'Current password incorrect');
                }
            }
            if ($response->status() == ('200')) {
                return back()->with('success', 'Successful Change Password!');
            }
            return back()->with('warning', 'Somthing Wrong With Data!');

        } catch (\Exception $e) {
            dd($e);
        }
    }
}