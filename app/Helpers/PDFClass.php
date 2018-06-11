<?php 

namespace App\Helpers;

use PDF;

class PDFClass {

    public function downloadPDF($client, $registration)
    {
        $pdf = PDF::loadView('pdfs.registration', compact('client', 'registration'));
        return $pdf->download('test.pdf');
    }
}