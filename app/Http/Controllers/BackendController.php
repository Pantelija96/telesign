<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;

class BackendController extends Controller
{
    
    public function uploadNumberCsv(Request $request){

        $request->validate([
                'csvFile' => 'required'
        ]);

        $path = $request->file('csvFile')->store('temp');
        $file = $request->file('csvFile');
        $fileName = time().$file->getClientOriginalName();
        $file->move(public_path('csvUploads'), $fileName);

        return redirect()->action(
            [FrontendController::class, 'showHome'], ['uploadedCsv' => $fileName]
        );

    }
    
}
