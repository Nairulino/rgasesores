<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
     /**
     * Show the appolication first page
     *
     */
    public function welcome()
    {
        return view('landingPage');
    }

    public function login()
    {
        if(Auth::user() == null)
            return view('welcome');
        else
            return view('pages.home');
    }
}
