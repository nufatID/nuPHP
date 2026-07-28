<?php

namespace App\Models;

use Dompdf\Dompdf;
use Dompdf\Options;

class invoiceModel
{
    public function __construct()
    {
    }

    public function pdfrender($template, $data)
    {
        ob_start();
        View($template, $data);
        $html = ob_get_clean();

        // Initialize DOMPDF and set options
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);

        // Load the HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (1 = download, 0 = preview)
        $dompdf->stream("invoice.pdf", array("Attachment" => 0));
    }
}
