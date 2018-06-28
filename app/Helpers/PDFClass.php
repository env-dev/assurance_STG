<?php 

namespace App\Helpers;

use PDF;

class PDFClass {

    public function downloadPDF($view, $client, $registration, $smartphone, $agency)
    {
        $pdf = PDF::loadView($view, compact('client', 'registration', 'smartphone', 'agency'));
        return $pdf->stream();
    }
}