<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
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
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
    }

    public function tracking_expenses(){
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
    }

    public function tracking_incomes(){
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
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
