<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\LazyCollection;
use MongoDB\BSON\ObjectId;


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

    public function addNewNumber(Request $request){
        $number = $request->get('number');
        $email = $request->get('email');
        $ip = $request->get('ip');
        $id = $request->get('id');

        $obj = [
            'number' => $number,
            'email' => $email,
            'ip' => $ip,
            '_id' => new ObjectID()
        ];

        $response = Project::where('_id', '=', $id)->push('numbers', array($obj));

        if($response){
            return response()->json(array(['msg'=> "Successfully added!", "_id" => $obj['_id']]), 200);
        }
        else{
            return response()->json(array('msg'=> "Some error occurred!"), 500);
        }
    }

    public function editNumber(Request $request){
        //return response()->json(array(['msg'=> "Some error occurred!", 'error' => $request->all()]), 500);
        $number = $request->get('number');
        $email = $request->get('email');
        $ip = $request->get('ip');
        $id = $request->get('id');
        $numberId = $request->get('numberId');

        $response = Project::where('_id','=',$id)
            ->where('numbers._id','=',$numberId)
            ->update([
                'numbers.$.number' => $number,
                'numbers.$.ip' => $ip,
                'numbers.$.email' => $email
            ]);

        if($response){
            return response()->json(array(['msg'=> "Successfully edited!", "numberId" => $numberId]), 200);
        }
        else{
            return response()->json(array(['msg'=> "Some error occurred!", 'error' => $response]), 500);
        }
    }

    public function deleteNumber(Request $request){
        $id = $request->get('id');
        $numberId = $request->get('numberId');


        $response = Project::where('_id','=',$id)
            ->pull('numbers', [
                '_id' => new ObjectId($numberId)
            ]);

        if($response){
            return response()->json(array(['msg'=> "Successfully deleted number!", "numberId" => $numberId]), 200);
        }
        else{
            return response()->json(array(['msg'=> "Some error occurred!", 'error' => $response]), 500);
        }
    }

    public function uploadCsv(Request $request){
        //return dd($request->all());
        $request->validate([
            'csvFile' => 'required',
            'projectId' => 'required'
        ]);

        $path = $request->file('csvFile')->store('temp');
        $file = $request->file('csvFile');
        $fileName = str_replace(" ","_", time().$file->getClientOriginalName());
        $file->move(public_path('csvUploads'), $fileName);

        $csvFile = file(public_path('csvUploads/'.$fileName));
        $dataArray = [];
        foreach ($csvFile as $line) {
            $obj = [
                'number' => str_getcsv($line)[0],
                'email' => "",
                'ip' => "",
                '_id' => new ObjectID()
            ];
            $dataArray[] = $obj;
        }
        array_shift($dataArray);

        $response = Project::where('_id', '=', $request->get('projectId'))->push('numbers', $dataArray);

        return redirect()->action(
            [FrontendController::class, 'project'], ['id' => $request->get('projectId')]
        );



//        LazyCollection::make(function () use ($fileName) {
//            $file = fopen(public_path('csvUploads/'.$fileName), 'r');
//            while ($data = fgetcsv($file)) {
//                yield $data;
//            }
//        })->skip(1)->each(function ($data) {
//            // Process csv row
//            var_dump($data);
//        });
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
