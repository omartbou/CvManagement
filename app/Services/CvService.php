<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvService
{
    public function handleFileUpload(Request $request): string
    {
        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:20480', // Max 20MB
        ]);

        return $request->file('cv')->store('cvs','public');
    }
}
