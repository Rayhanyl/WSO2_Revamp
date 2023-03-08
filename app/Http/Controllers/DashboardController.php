<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->url = getUrlApi();
    }

    public function dashboard(){

        if (session('token') == null) {
            session()->forget('token');
            return redirect(route('login'));
        }

        $application = getUrl($this->url .'/applications?');

        return view('dashboard.index', compact('application'));
    }
}
