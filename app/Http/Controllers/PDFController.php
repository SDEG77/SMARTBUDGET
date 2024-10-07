<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ledger;
use App\Models\Tracking;


class PDFController extends Controller
{
    public function ledgerPdf(Request $request) {
        $data = Ledger::where('user_id', auth()->user()->id)->get();

        $pdf = PDF::loadView('pdf.ledger',  ['datas'=> $data]);

        return $pdf->download('ledger-data.pdf');
    }

    public function trackerPdf(Request $request) {
        $data = Tracking::where('user_id', auth()->user()->id)->get();

        $pdf = PDF::loadView('pdf.tracking',  ['datas'=> $data]);

        return $pdf->download('tracking-data.pdf');
    }
}
