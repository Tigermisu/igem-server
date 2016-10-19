<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Download;

class DownloadController extends Controller
{
    public function registerDownload(Request $request) {
        $dl = new Download;
        
        $dl->email = $request->email;
        $dl->country = $request->country;
        $dl->name = $request->name;
        $dl->language = $request->language;

        $dl->save();

        return response("Okay", 200)
                    ->withHeaders([
                        'Content-Type' => "application/json",
            ]);
    }
}
