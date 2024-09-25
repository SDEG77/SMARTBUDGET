<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;

class AllocationController extends Controller
{
    public function allocate(Request $request){
        // dd($request);
        $validated = $request->validate([
            'food' => 'required|numeric',
            'rent' => 'required|numeric',
            'transportation' => 'required|numeric',
            'loan' => 'required|numeric',
            'shopping' => 'required|numeric',
            'mobile' => 'required|numeric',
            'savings' => 'required|numeric',
            'school' => 'required|numeric',
            'others' => 'required|numeric',
        ]); 

        // dd($validated);

        $pizzaCount = Allocation::where('user_id', auth()->user()->id)->count();

        if($pizzaCount <= 0){
            auth()->user()->allocations()->create($validated);

            return to_route('planner');
        } else {
            auth()->user()->allocations()->where('user_id', auth()->user()->id)->delete();

            auth()->user()->allocations()->create($validated);

            return to_route('planner');
        }
    }
}
