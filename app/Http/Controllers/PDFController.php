<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use mikehaertl\pdftk\Pdf;

class PDFController extends Controller
{
     public function downloadPDF()
    {
    	// dd (public_path());
        $filePath = public_path('files/NiceSnippets');

        $pdf = new Pdf($filePath);

        $password = '123456';
        $userPassword = '123456a';

        $result = $pdf->allow('AllFeatures')
                        ->setPassword($password)
                        ->setUserPassword($userPassword)
                        ->passwordEncryption(128)
                        ->saveAs($filePath);

        if ($result === false) {
            $error = $pdf->getError();
        }

        return response()->download($filePath);
    }
}
