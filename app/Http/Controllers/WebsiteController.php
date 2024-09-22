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

    public function dashboard(){
        return view('website.dashboard');
    }

    public function tracking(){
        return view('website.tracking');
    }
    
    public function ledger(){
        return view('website.ledger');
    }
    public function planner(){
        return view('website.planner');
    }
    public function about(){
        return view('website.about');
    }
}
