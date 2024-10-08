<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ledger;
use App\Models\Tracking;


class PDFController extends Controller
{
    // LEDGER FUNCTIONS
    public function ledgerPdf(Request $request) {
        $data = Ledger::where('user_id', auth()->user()->id)
        ->get();
        
        $pdf = PDF::loadView('pdf.ledger',  ['datas'=> $data, 'type' => 'all']);
        
        return $pdf->download('ledger-data.pdf');
    }
    public function ledgerPayPdf(Request $request) {
        $data = Ledger::where('user_id', auth()->user()->id)
        ->where('type', 'pay')
        ->get();

        $pdf = PDF::loadView('pdf.ledger',  ['datas'=> $data, 'type' => 'pay']);

        return $pdf->download('ledger-data.pdf');
    }
    public function ledgerBuyPdf(Request $request) {
        $data = Ledger::where('user_id', auth()->user()->id)
        ->where('type', 'buy')
        ->get();

        $pdf = PDF::loadView('pdf.ledger',  ['datas'=> $data, 'type' => 'buy']);

        return $pdf->download('ledger-data.pdf');
    }

    // TRACKER FUNCTIONS
    public function trackerPdf(Request $request) {
        $data = Tracking::where('user_id', auth()->user()->id)->get();

        $pdf = PDF::loadView('pdf.tracking',  ['datas'=> $data, 'type'=> 'all']);

        return $pdf->download('tracking-data.pdf');
    }
    public function trackerOutgoingPdf(Request $request) {
        $data = Tracking::where('user_id', auth()->user()->id)
        ->where('mode', 'outgoing')
        ->get();

        $pdf = PDF::loadView('pdf.tracking',  ['datas'=> $data, 'type' => 'outgoing']);

        return $pdf->download('tracking-data.pdf');
    }
    public function trackerIngoingPdf(Request $request) {
        $data = Tracking::where('user_id', auth()->user()->id)
        ->where('mode', 'ingoing')
        ->get();

        $pdf = PDF::loadView('pdf.tracking',  ['datas'=> $data, 'type' => 'ingoing']);

        return $pdf->download('tracking-data.pdf');
    }
}
