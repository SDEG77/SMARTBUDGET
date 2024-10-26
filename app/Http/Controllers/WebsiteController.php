<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
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

    public function profile(){
        return view('website.account.profile', [
            'user' => auth()->user(),
            'courses' => Course::all()->sortBy('course'),
        ]);
    }

    public function dashboard(){
        return view('website.dashboard',[
            // USER DATA
            'user' => auth()->user(),

            // FOR THE EXPENSE TALLY
            'total_expense' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->sum('amount'),

            // FOR THE INCOME TALLY
            'total_income' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->sum('amount'),

            // DATA FOR THE EXPENSE SUMMARY DONUT
            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->get(),

            // DATA FOR THE INCOME SUMMARY DONUT
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->get(),

            // Gets the most recent date for incomes and expenses
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->whereBetween('date', [Carbon::yesterday()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('date', 'desc')->get(),

            // EXPENSE DATAS BELOW THE DONUT CHART
            'expenses' => Tracking::where('mode', 'outgoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->orderBy('category', 'asc')
            ->get(),

            // INCOME DATAS BELOW THE DONUT CHART
            'incomes' => Tracking::where('mode', 'ingoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->orderBy('category', 'asc')
            ->get(),

            // LINES ARE FOR THE LINE CHART (THEY NEED TO BE GROUPED TOGETHER UNLIKE 'expenses' & 'incomes')
            'expense_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
            
            'income_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
        ]);
    }

    public function tracking(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')            
            ->get(),
            
            'state' => 'null',

            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
            'daily_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->whereDate('date', Carbon::today())
            ->where('mode', 'outgoing')
            ->average('amount'),

            // 'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            // 'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
            'pageType' => 'all',
        ]);
    }

    public function tracking_expenses(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')  
            ->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
            'daily_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->whereDate('date', Carbon::today())
            ->where('mode', 'outgoing')
            ->average('amount'),

            // 'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            // 'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
            'pageType' => 'outgoing',
        ]);
    }

    public function tracking_incomes(){
        return view('website.tracking', [
            'user' => auth()->user(),
            'tracks' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')  
            ->get(),
            'state' => 'null',
            'total_expense' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->sum('amount'),
            'total_income' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->sum('amount'),
            'daily_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->whereDate('date', Carbon::today())
            ->where('mode', 'outgoing')
            ->average('amount'),

            // 'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'outgoing')->get(),
            // 'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)->where('mode', 'ingoing')->get(),
            'pageType' => 'ingoing',
        ]);
    }
    
    public function ledger(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->orderBy('when', 'desc')
            ->orderBy('created_at', 'desc')
            ->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
            'pageType' => 'all',
        ]);
    }

    public function ledger_toPay(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'pay')
            ->orderBy('when', 'desc')
            ->orderBy('created_at', 'desc')
            ->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
            'pageType' => 'pay',
        ]);
    
    }
    public function ledger_toBuy(){
        return view('website.ledger', [
            'user' => auth()->user(),
            'ledgers' => Ledger::where('user_id', auth()->user()->id)->where('type', 'buy')
            ->orderBy('when', 'desc')
            ->orderBy('created_at', 'desc')
            ->get(),
            'checks_present' => Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->get(),
            'pageType' => 'buy',
        ]);
    }

    public function planner(){
        return view('website.planner', [
            'user' => auth()->user(),
            'expecteds' => ExpectedIncome::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get(),
            'allocation' => Allocation::where('user_id', auth()->user()->id)->first(),
            'total_expected' => ExpectedIncome::where('user_id', auth()->user()->id)->sum('amount'),
            'target_income' => User::where('id', auth()->user()->id)->first()->target_income,
            'categories' => Category::all()->sortBy('category'),
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
