<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
      /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('pdf.index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create()
    {
        $pdf = pdf::loadView('pdf.pdf');

        $path = public_path('pdf/');
        $fileName =  time().'.'. 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/'.$fileName);
        return response()->download($pdf);
    }
}
