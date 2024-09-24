<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\User;
use App\Models\Tracking;
use App\Models\Allocation;
use App\Models\ExpectedIncome;
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
        return view('website.account.profile', ['user' => auth()->user()]);
    }

    public function dashboard(){
        return view('website.dashboard');
    }

    public function tracking(){
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
    }

    public function tracking_expenses(){
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
    }

    public function tracking_incomes(){
        return view('website.tracking', [
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->orderBy('date', 'desc')->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
        ]);
    }
    
    public function ledger(){
        return view('website.ledger', [
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    }

    public function ledger_toPay(){
        return view('website.ledger', [
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'pay')->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    
    }
    public function ledger_toBuy(){
        return view('website.ledger', [
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'buy')->orderBy('when', 'desc')->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
        ]);
    }

    public function planner(){
        return view('website.planner', [
            'expecteds' => ExpectedIncome::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get(),
            'allocation' => Allocation::where('user_id', auth()->user()->id)->first(),
            'total_expected' => ExpectedIncome::where('user_id', auth()->user()->id)->sum('amount'),
            'target_income' => User::where('id', auth()->user()->id)->first()->target_income
        ]);
    }

    public function reset_planner(User $user, ExpectedIncome $expectedIncome, Allocation $allocation){
        $user->where('id', auth()->user()->id)->update([
            'target_income' => 0,
        ]);

        $expectedIncome->where('user_id', auth()->user()->id)->delete();
        $allocation->where('user_id', auth()->user()->id)->delete();

        return to_route('planner');
    }

    public function about(){
        return view('website.about');
    }
}
