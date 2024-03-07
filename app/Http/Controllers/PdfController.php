<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use TCPDF;
use TCPDF_FONTS;


class PdfController extends Controller
{
    public function pdf_export(Request $request)
    {
        $pdf = new TCPDF();

        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->AddPage();

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(0, 10, 'Invoice Content Here', 0, 1);

        $pdf->Output('invoice.pdf', 'D');
    }

    public function generateInvoice()
    {
        $tcpdf_fonts = new TCPDF_FONTS();
        $font = $tcpdf_fonts->addTTFfont(storage_path('fonts/ipaexg.ttf'));

        $pdf = new TCPDF();
        $pdf->SetFont($font, '', 8);

        $pdf->AddPage();
        $pdf->writeHTML(view('pdf.pdf')->render());

        return $pdf->Output('invoice.pdf', 'D');
    }
}
