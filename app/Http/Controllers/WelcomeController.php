<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
     /**
     * Show the appolication first page
     *
     */
    public function welcome()
    {
        if(Auth::user() == null)
            return view('welcome');
        else
            return view('pages.home');
    }
}
