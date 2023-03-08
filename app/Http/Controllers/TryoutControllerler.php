<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TryoutControllerler extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }

    public function tryout(Request $request,$id){

        if (session('token') == null) {
            session()->forget('token');
            return redirect(route('login'));
        }

        $application = getUrl($this->url .'/applications/'. $id);
        
        if ($application  == null) {
            session()->forget('token');
            return redirect(route('login'));
        }

        $subscription = getUrl($this->url .'/subscriptions?applicationId='. $id);
        $apptoken = getUrl($this->url .'/applications/'.$id.'/oauth-keys');
        $production = collect($apptoken->list)->where('keyType', 'PRODUCTION')->first();
        $sandbox = collect($apptoken->list)->where('keyType', 'SANDBOX')->first();
        return view('tryout.index2', compact('application','subscription','sandbox','production'));
    }
    // public function tryout(Request $request,$id){

    //     if (session('token') == null) {
    //         session()->forget('token');
    //         return redirect(route('login'));
    //     }

    //     $application = getUrl($this->url .'/applications/'. $id);
    //     $subscription = getUrl($this->url .'/subscriptions?applicationId='. $id);

    //     return view('tryout.index2', compact('application','subscription'));
    // }

    public function generatetestkeyapikey(Request $request)
    {

        try {    
            $payloads = [
                'validityPeriod' => "-1",
                'additionalProperties' => null,
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->applicationid.'/api-keys/'.$request->keytype.'/generate');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '400') {
                return back()->with('warning', 'Invalid keyType, Sandbox Or Production');
            }
            if ($response->status() == ('200' || '201')) {
                    return response()->json($data);
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function generatetestkeyoauth(Request $request)
    {   
        if ($request->keytype == 'SANDBOX') {
            $mappingid = $request->sandboxmappingid;
            $consumersecret = $request->sandboxconsumersecret;
        }else{
            $mappingid = $request->productionmappingid;
            $consumersecret = $request->productionconsumersecret;
        }
        
        $type = $request->keytype;

        try {

            $payloads = [
                'consumerSecret' => $consumersecret,
                'validityPeriod' => 3600,
                'scopes' => [],
                'revokeToken' => '',
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->post($this->url.'/applications/'. $request->applicationid.'/oauth-keys/'.$mappingid.'/generate-token');
                
            $data = json_decode($response->getBody()->getContents());

            if ($response->status() == '409') {
                return back()->with('warning', 'Error 409!');
            }
            if ($response->status() == ('200' || '201')) {
                if ($data == null) {
                    Alert::error($type, 'Generate application keys first');
                    return response()->json(['status' => 'error', 'data' => $data,$type]);
                } else {
                    return response()->json(['status' => 'success', 'data' => $data]);
                }
            }
            return back()->with('warning', 'Somthing Wrong With Data!');
            
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function downloadformatopenapi(Request $request){

        $swagger = getUrl($this->url .'/apis/'.$request->id_api.'/swagger');

        if ($swagger !== [] ) {

            if (isset ($swagger->swagger)) {
                $swagger->securityDefinitions->default->authorizationUrl = "https://194.233.88.81:9443/oauth2/authorize";
            }else{
                $swagger->components->securitySchemes->default->flows->implicit->authorizationUrl = "https://194.233.88.81:9443/oauth2/authorize";
            }   
        }

        $jsonString = json_encode($swagger);
        $data = str_replace("\\/", "/", $jsonString);
        $file = storage_path('app/example.json');
        file_put_contents($file, $data);
        return response()->download($file, 'swagger.json', ['Content-Type' => 'application/json']);
    }

    public function jsontryout(Request $request){

        $swagger = getUrl($this->url .'/apis/'.$request->id_api.'/swagger');

        if ($swagger !== [] ) {

            if (isset ($swagger->swagger)) {
                $swagger->securityDefinitions->default->authorizationUrl = "https://194.233.88.81:9443/oauth2/authorize";
            }else{
                $swagger->components->securitySchemes->default->flows->implicit->authorizationUrl = "https://194.233.88.81:9443/oauth2/authorize";
            }   
        }

        return $swagger;
    }

}
