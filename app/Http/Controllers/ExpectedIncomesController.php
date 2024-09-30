<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpectedIncome;

class ExpectedIncomesController extends Controller
{
    public function store(Request $request){
        $request->merge([
            'date' => strip_tags($request->input('date')),
            'source' => strip_tags($request->input('source')),
            'amount' => strip_tags($request->input('amount')),
        ]);

        $validate = $request->validate([
            'date' => 'required|date',
            'source' => 'required|string|min:3',
            'amount' => 'required|numeric|min:1'
        ]);

        auth()->user()->expected_incomes()->create($validate);

        return to_route('planner');
    }
    public function update(Request $request){
        $request->merge([
            'id' => strip_tags($request->input('id')),
            'date' => strip_tags($request->input('date')),
            'source' => strip_tags($request->input('source')),
            'amount' => strip_tags($request->input('amount')),
        ]);

        $validate = $request->validate([
            'id' => 'required|integer|min:1',
            'date' => 'required|date',
            'source' => 'required|string|min:3',
            'amount' => 'required|numeric|min:1'
        ]);

        ExpectedIncome::where('user_id' , auth()->user()->id)->where('id', $validate['id'])->update($validate);

        return to_route('planner');
    }
    public function delete(Request $request){
        $request->merge([
            'id' => strip_tags($request->input('id')),
        ]);

        $validate = $request->validate([
            'id' => 'required|integer|min:1'
        ]);

        ExpectedIncome::where('user_id' , auth()->user()->id)->where('id', $validate['id'])->delete();

        return to_route('planner');
    }
}
