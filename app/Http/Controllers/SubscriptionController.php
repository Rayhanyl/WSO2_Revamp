<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }

    public function subscription(Request $request,$id){

        if (session('token') == null) {
            session()->forget('token');
            return redirect(route('login'));
        }

        $application = getUrl($this->url .'/applications/'. $id);

        if($application  == null){
            session()->forget('token');
            return redirect(route('login'));
        }

        $subscription = getUrl($this->url .'/subscriptions?applicationId='. $id);
        return view('subscription.index', compact('application','subscription'));
    }

    public function createsubscription(Request $request, $id)
    {        
        $application = getUrl($this->url .'/applications/'. $id);

        if ($application->applicationId == null) {
            session()->forget('token');
            return redirect(route('login'));
        }

        $apilist = getUrl($this->url . '/apis'); 
        $publishapi = collect($apilist->list)->where('lifeCycleStatus', 'PUBLISHED')->all();
        $subscription = getUrl($this->url . '/subscriptions?applicationId='. $id);
        $filltersubscription = collect($subscription->list)->pluck('apiId')->all();
                
        $notsubscription = [];
        foreach ($publishapi as $key => $value) {
            if(!in_array($value->id, $filltersubscription)){
                $notsubscription[] = $value;
            }
        }

        return view('subscription.createsubscription', compact('application','notsubscription'));
    }

    public function storesubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'applicationid'      => 'required',
            'apiid'              => 'required',
            'status'             => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('warning', 'Oh No Cant Subscribe!');
        }else{
            
            try {

                $payloads = [
                    'applicationId' => $request->applicationid,
                    'apiId' => $request->apiid,
                    'throttlingPolicy' => $request->status,
                    'requestedThrottlingPolicy' => $request->status,
                ];

                $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Authorization' => 'Bearer '.$request->session()->get('token'),
                ])
                ->withBody(json_encode($payloads),'application/json')
                ->post($this->url. '/subscriptions');

                $data =json_decode($response->getBody()->getContents());

                return response()->json(['status' => 'success', 'data' => $data]);
                // return redirect()->route('subscription', $request->applicationid)->with('success', 'Successful Subscribe API!');
                
            } catch (\Exception $e) {
                dd($e);
            }
        }
    }

    public function editsubscription(Request $request)
    {
        if($request->ajax()){

            $subs = getUrl($this->url .'/subscriptions/'. $request->id_subs);
            return view('subscription.modal.editsubs', compact('subs'));
        }
        return abort(404);
    }

    public function updatesubscription(Request $request)
    {
        try {

            $payloads = [
                'applicationId' => $request->appid,
                'apiId' => $request->apiid,
                'throttlingPolicy' => $request->throttling,
                'requestedThrottlingPolicy' => $request->throttling,
                'status' => $request->status,
            ];

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->withBody(json_encode($payloads),'application/json')
            ->put($this->url. '/subscriptions/'. $request->subsid);

            $data =json_decode($response->getBody()->getContents());
            
            // return redirect()->back()->with('success', 'Successful Subscribe API!');
            return redirect()->route('subscription', $request->appid)->with('success', 'Successful Update Subscribe API!');
            
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function deletesubscription(Request $request, $id)
    {
        try {

            $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Authorization' => 'Bearer '.$request->session()->get('token'),
            ])
            ->delete($this->url . '/subscriptions/'. $id);
    
            $data =json_decode($response->getBody()->getContents());
    
            if($response->status() == 200)
            {
                return back()->with('success', 'Successful Delete Subscription!');
            } 
            
            return back()->with('error', 'Failed Delete Subscription');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function loadimgapi(Request $request){

        $response = Http::withOptions(['verify' => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.session()->get('token'),
            'Accept' => '*/*',
        ])
        ->get($this->url .'/apis/'.$request->id.'/thumbnail');

        $data = $response->getBody()->getContents();
        $base64 = base64_encode($data);
        $mime = "image/jpeg";
        $img = ('data:' . $mime . ';base64,' . $base64);
                
        return "<img class='img-thumbnail rounded mx-auto d-block' width='50' height='50' src=$img alt='ok' >";
    }
}
