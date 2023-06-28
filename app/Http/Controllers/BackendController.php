<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class BackendController extends Controller
{

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->flush();
        return redirect('/');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/')->with([
                'errorCode' => 1,
                'errorMsg' => 'Enter username and password!'
            ]);
        }

        $user = User::where([
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ])->first();

        if($user){
            $request->session()->put('user', $user);
            return redirect('/home');
        }

        return redirect('/')->with([
            'errorCode' => 2,
            'errorMsg' => 'User not found!'
        ]);
    }


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
