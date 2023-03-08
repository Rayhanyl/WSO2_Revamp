<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class LandingpageController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }


    public function landingpage(){

        $tags = 'frontend';
        $listapi = getApiLandingPage($this->url . '/apis?query=tag:'.$tags.'&limit=6'); 
        
        
        return view('landingpage.index', compact('listapi'));
    }
}
