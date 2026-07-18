<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;

class AllocationController extends Controller
{
    public function allocate(Request $request){
        // dd($request);
        $validated = $request->validate([
            'food' => 'required|numeric|max:6000',
            'rent' => 'required|numeric|max:15000',
            'transportation' => 'required|numeric|max:3000',
            'loan' => 'required|numeric|max:20000',
            'shopping' => 'required|numeric|max:3000',
            'mobile' => 'required|numeric|max:1400',
            'savings' => 'required|numeric|max:4000',
            'school' => 'required|numeric|max:25000',
            'others' => 'required|numeric|max:10000',
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
