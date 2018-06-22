<?php 

namespace App\Helpers;

use PDF;

class PDFClass {

    public function downloadPDF($client, $registration, $smartphone, $agency)
    {
        $pdf = PDF::loadView('pdfs.registration', compact('client', 'registration', 'smartphone', 'agency'));
        return $pdf->stream();
    }
}