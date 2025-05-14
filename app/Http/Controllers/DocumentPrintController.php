<?php

namespace App\Http\Controllers;

use App\Models\BarangayLogo;
use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DocumentPrintController extends Controller
{
    public function print(DocumentRequest $document)
    {
        $resident = $document->resident;
        $barangayLogo = BarangayLogo::first();

        $logoPath = $barangayLogo ? $barangayLogo->logo_path : null;

        $pdf = Pdf::loadView('documents.clearance', [
            'resident' => $resident,
            'purpose' => $document->purpose,
            'barangayName' => $resident->barangay->name,
            'barangayLogo' => $logoPath,
        ]);

        return $pdf->stream('barangay-clearance.pdf');
    }
}
