<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DocumentationController extends Controller
{
    public function __construct()
    {
        $this->url = getUrlApi();
    }

    public function documentation(Request $request)
    {
        $listapi = getApiLandingPage($this->url . '/apis');        
        $listapipublish = collect($listapi->list)->where('lifeCycleStatus', 'PUBLISHED')->all();  

        return view('documentation.index', compact('listapipublish'));
    }

    public function listdocumentation(Request $request)
    {
        $listdocument = getApiLandingPage($this->url . '/apis/'.$request->id_api.'/documents');
        $data = collect($listdocument->list)->groupBy('type')->all();
        $api_id = $request->id_api;

        return view('documentation._listdocumentation', compact('data','api_id'));
    }

    public function resultdocumentation(Request $request)
    {   
        $sumarydoc = $request->summary;
        $listapi = getApiLandingPage($this->url . '/apis/'.$request->id_api.'/documents/'.$request->id_document);
        if($listapi == null){
            $request->session()->forget('token');
            return redirect(route('login'));
        }
        $response = Http::withOptions(['verify' => false])
        ->get('https://194.233.88.81:9443/api/am/devportal/v2.1/apis/'.$request->id_api.'/documents/'.$request->id_document.'/content');
        $data = $response->getBody()->getContents();
        $sctype = $listapi->sourceUrl;
        $typesource = $request->sourcetype;

        switch ($request->sourcetype) {
            case 'INLINE':
                return view('documentation.resultdocumentation._inline', compact('data','sumarydoc','typesource'));
                break;
            case 'URL':
                return view('documentation.resultdocumentation._url', compact('data','sctype','sumarydoc','typesource'));
                break;
            case 'MARKDOWN':
                return view('documentation.resultdocumentation._markdown', compact('data','sumarydoc','typesource'));
                break;
            case 'FILE':
                return view('documentation.resultdocumentation._file', compact('data','sumarydoc','typesource'));
                break;
            default:
                break;
        }
    }
}
