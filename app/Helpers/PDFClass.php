<?php 

namespace App\Helpers;

use PDF;

class PDFClass {

    public function downloadPDF($view, $client, $pdf_Registration, $smartphones, $agency)
    {
        $pdf = PDF::loadView($view, compact('client', 'pdf_Registration', 'smartphones', 'agency'));
        return $pdf->download();
    }
}