<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $data = [];

    public function showLogin(){
        return view('pages.login', $this->data);
    }

    public function showHome($uploadedCsv = null){
        if($uploadedCsv){
            $csvFile = file(public_path('csvUploads/'.$uploadedCsv));
            $data = [];
            foreach ($csvFile as $line) {
                $data[] = str_getcsv($line);
            }

            $this->data['csvNumbers'] = $data;
        }
        return view('pages.home', $this->data);
    }

    public function showRoi(){
        return view('pages.roi', $this->data);
    }
}
