<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpectedIncome;

class ExpectedIncomesController extends Controller
{
    public function store(Request $request){
        $validate = $request->validate([
            'date' => 'required|date',
            'source' => 'required|string|min:3',
            'amount' => 'required|string|min:1'
        ]);

        auth()->user()->expected_incomes()->create($validate);

        return to_route('planner');
    }
}
