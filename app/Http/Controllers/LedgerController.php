<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|min:3',
            'what' => 'required|string|min:3',
            'when' => 'required|date',
            'where' => 'required|string|min:3',
            'amount' => 'required|integer|min:1',
        ]);

        auth()->user()->ledgers()->create($validated);

        return to_route('ledger');
    }

    public function update(Request $request, Ledger $ledger)
    {
        // dd($request);

        $validated = $request->validate([
            'type' => 'required|string|min:3',
            'what' => 'required|string|min:3',
            'when' => 'required|date',
            'where' => 'required|string|min:3',
            'amount' => 'required|integer|min:1',
        ]);

        $ledger->where('id', $ledger->id)->update($validated);

        return to_route('ledger');
    }

    public function check(Request $request, Ledger $ledger){
        $validated = $request->validate([
            'ninja_check' => 'required|integer',
            'ninja' => 'required|integer'
        ]);

        auth()->user()->ledgers()->where('id', $validated['ninja'])->update(['checked' => !$validated['ninja_check']]);

        return to_route('ledger');
    }

    public function destroy(Ledger $ledger)
    {
        $ledger->delete();

        return to_route('ledger');
    }

    public function destroy_selected(){
        Ledger::where('user_id', auth()->user()->id)->where('checked', 1)->delete();

        return to_route('ledger');
    }
}
