<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard_weekly(){
        return view('website.dashboard',[
            // USER DATA
            'user' => auth()->user(),

            // FOR THE EXPENSE TALLY
            'total_expense' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('amount'),

            // FOR THE INCOME TALLY
            'total_income' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('amount'),

            // FOR THE EXPENSE DONUT
            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get(),

            // FOR THE INCOME DONUT
            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get(),

            // Gets the most recent date for incomes and expenses
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->whereBetween('date', [Carbon::yesterday()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('date', 'desc')->get(),

            // EXPENSE DATA BELOW THE DONUT CHART
            'expenses' => Tracking::where('mode', 'outgoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('category')
            ->get(),

            // INCOME DATA BELOW THE DONUT CHART
            'incomes' => Tracking::where('mode', 'ingoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('category')
            ->get(),

            // LINES ARE FOR THE LINE CHART (THEY NEED TO BE GROUPED TOGETHER UNLIKE 'expenses' & 'incomes')
            'expense_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
            
            'income_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
        ]);
    }

    public function dashboard_monthly(){
        return view('website.dashboard',[
            'user' => auth()->user(),
            'total_expense' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('amount'),

            'total_income' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get(),

            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get(),

            // Gets the most recent date for incomes and expenses
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->whereBetween('date', [Carbon::yesterday()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('date', 'desc')->get(),

            'expenses' => Tracking::where('mode', 'outgoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get(),

            'incomes' => Tracking::where('mode', 'ingoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get(),

            // LINES ARE FOR THE LINE CHART (THEY NEED TO BE GROUPED TOGETHER UNLIKE 'expenses' & 'incomes')
            'expense_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
            
            'income_line' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('DATE_FORMAT(date, "%Y-%m-%d") as state, SUM(amount) as state_total')
            ->groupBy('state')
            ->orderBy('state') 
            ->get(),
        ]);
    }


    public function dashboard_yearly(){
        return view('website.dashboard',[
            'user' => auth()->user(),
            
            'total_expense' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->sum('amount'),
            
            'total_income' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->sum('amount'),

            'track_all_expenses' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'outgoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->get(),

            'track_all_incomes' => Tracking::where('user_id', auth()->user()->id)
            ->where('mode', 'ingoing')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->get(),

            // Gets the most recent date for incomes and expenses
            'tracks' => Tracking::where('user_id', auth()->user()->id)
            ->whereBetween('date', [Carbon::yesterday()->startOfDay(), Carbon::today()->endOfDay()])
            ->orderBy('date', 'desc')->get(),

            'expenses' => Tracking::where('mode', 'outgoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->get(),

            'incomes' => Tracking::where('mode', 'ingoing')->select('category', Tracking::raw('SUM(amount) as total'))
            ->where('user_id', auth()->user()->id) 
            ->groupBy('category')
            ->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
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
}
