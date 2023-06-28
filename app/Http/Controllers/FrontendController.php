<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $data = [];

    public function showLogin(){
//        return dd(session()->all());
        if(isset(session()->all()['errorCode'])){
            $this->data['errorCode'] = session()->get('errorCode');
            $this->data['errorMsg'] = session()->get('errorMsg');
            session()->flush();
        }
        return view('pages.login', $this->data);
    }

    public function showHome($uploadedCsv = null){
//        return dd(session()->all()['user']['password']);
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

    public function mongo(){
        $test = Korisnik::all();
        return dd($test);
    }
}
