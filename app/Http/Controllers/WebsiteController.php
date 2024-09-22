<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function welcome(){
        return view('website.welcome');
    }

    public function home(){
        return view('website.home');
    }

    public function profile(){
        return view('website.account.profile');
    }
}
