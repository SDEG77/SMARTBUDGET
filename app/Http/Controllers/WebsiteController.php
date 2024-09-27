<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\User;
use App\Models\Tracking;
use App\Models\Allocation;
use App\Models\ExpectedIncome;
use Carbon\Carbon;

$start = Carbon::yesterday()->startOfDay(); // Start of yesterday
$end = Carbon::today()->endOfDay();

class WebsiteController extends Controller
{
    public function welcome(){
        return view('website.welcome');
    }

    public function home(){
        return view('website.home', [
            'user' => auth()->user(),
        ]);
    }

    public function profile(){
        return view('website.account.profile', ['user' => auth()->user()]);
    }

    public function dashboard(){
        return view('website.dashboard',[
            'user' => auth()->user(),
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),

            // Gets the most recent date for incomes and expenses
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->whereBetween('date', [Carbon::yesterday()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('date', 'desc')->get(),

            'expenses' => Tracking::where('mode', 'outgoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->get(),

            'incomes' => Tracking::where('mode', 'ingoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->get()
        ]);
    }

    public function tracking(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
        ]);
    }

    public function tracking_expenses(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
        ]);
    }

    public function tracking_incomes(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
        ]);
    }
    
    public function ledger(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    }

    public function ledger_toPay(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'pay')->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    
    }
    public function ledger_toBuy(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'buy')->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    }

    public function planner(){
        return view('website.planner', [
            'user' => auth()->user(),
            'expecteds' => ExpectedIncome::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get(),
            'allocation' => Allocation::where('user_id', auth()->user()->id)->first(),
            'total_expected' => ExpectedIncome::where('user_id', auth()->user()->id)->sum('amount'),
            'target_income' => User::where('id', auth()->user()->id)->first()->target_income,
        ]);
    }

    public function reset_planner( User $user, ExpectedIncome $expectedIncome, Allocation $allocation){
        $expectedIncome->where('user_id', auth()->user()->id)->delete();
        $allocation->where('user_id', auth()->user()->id)->delete();

        return to_route('planner');
    }

    public function about(){
        return view('website.about', [
            'user' => auth()->user(),
        ]);
    }
}
