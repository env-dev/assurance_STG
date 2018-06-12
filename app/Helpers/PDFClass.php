<?php 

namespace App\Helpers;

use PDF;

class PDFClass {

    public function downloadPDF($client, $registration, $smartphone)
    {
        $pdf = PDF::loadView('pdfs.registration', compact('client', 'registration', 'smartphone'));
        return $pdf->stream();
    }
}