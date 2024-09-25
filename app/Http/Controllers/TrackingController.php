<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'description' => 'string|min:1|required',
            'category' => 'string|min:2|required',
            'mode' => 'string|min:6|required',
            'date' => 'date|required|before_or_equal:today',
            'amount' => 'numeric|min:1|required',
        ]);

        auth()->user()->tracking()->create($validate);

        return to_route('tracking');
    }

    public function delete(Tracking $tracking)
    {
        $tracking->delete();

        return to_route('tracking');
    }
}
