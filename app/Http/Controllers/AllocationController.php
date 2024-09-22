<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocation;

class AllocationController extends Controller
{
    public function allocate(Request $request){
        $validated = $request->validate([
            'food' => 'required|integer|min:1',
            'rent' => 'required|integer|min:1',
            'transportation' => 'required|integer|min:1',
            'loan' => 'required|integer|min:1',
            'shopping' => 'required|integer|min:1',
            'mobile' => 'required|integer|min:1',
            'savings' => 'required|integer|min:1',
            'school' => 'required|integer|min:1',
            'others' => 'required|integer|min:1',
        ]); 

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
