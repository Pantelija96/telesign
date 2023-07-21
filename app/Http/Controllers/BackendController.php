<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use App\Models\Number;
use App\Models\Project;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\LazyCollection;
use MongoDB\BSON\ObjectId;
use Illuminate\Support\Facades\Http;


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
        $num = $request->get('number');
        $email = $request->get('email');
        $ip = $request->get('ip');
        $id = $request->get('id');

        $number = new Number();

        $number->number = $num;
        $number->email = $email;
        $number->ip = $ip;
        $number->projectId = $id;
        $number->scores = [];

        $response = $number->save();

        if($response){
            return response()->json(array(['msg'=> "Successfully added!", "_id" => $number['_id'], 'number' => $number['number']]), 200);
        }
        else{
            return response()->json(array('msg'=> "Some error occurred!"), 500);
        }
    }

    public function editNumber(Request $request){
//        return response()->json(array(['msg'=> "Some error occurred!", 'error' => $request->all()]), 500);
        $number = $request->get('number');
        $email = $request->get('email');
        $ip = $request->get('ip');
        $numberId = $request->get('numberId');

        $response = Number::where('_id','=',$numberId)
            ->update([
                'number' => $number,
                'ip' => $ip,
                'email' => $email
            ]);

        if($response){
            return response()->json(array(['msg'=> "Successfully edited!", "numberId" => $numberId, "number" => $number]), 200);
        }
        else{
            return response()->json(array(['msg'=> "Some error occurred!", 'error' => $response]), 500);
        }
    }

    public function deleteNumber(Request $request){
        $numberId = $request->get('numberId');


        $response = Number::where('_id', $numberId)->delete();

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
                'scores' => [],
                'projectId' => $request->get('projectId')
            ];
            $dataArray[] = $obj;
        }
        array_shift($dataArray);


        $response = Number::insert($dataArray);

        return redirect()->action(
            [FrontendController::class, 'project'], ['id' => $request->get('projectId')]
        );
    }

    public function editUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'username' => 'required',
            'passwordA' => 'same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errorCode' => 1,
                'errorMsg' => 'Please fill out all required field!'
            ]);
        }

        $dataForUpdate = [
            'name' => $request->get('name'),
            'last_name' => $request->get('lastname'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'password' => $request->get('oldPassword'),
        ];

        if($request->get('password') == $request->get('passwordA') && $request->get('passwordA') != null){
            $dataForUpdate["password"] =$request->get('passwordA');
        }

        $response = User::where('_id','=',$request->session()->get('user')['_id'])
            ->update($dataForUpdate);

        $user = User::where('_id','=',$request->session()->get('user')['_id'])
            ->first();


        if($response){
            session()->forget('user');
            $request->session()->put('user', $user);
            return redirect('/home2')->with([
                'success' => 1,
                'successMsg' => 'Successfully changed profile data!'
            ]);
        }
        else{
            return redirect()->back()->with([
                'errorCode' => 1,
                'errorMsg' => 'Some unexpected error happened!'
            ]);
        }


    }

    public function scoreNumbers(Request $request){
//        set_time_limit(0);
        //score numbers for this project
        $id = $request->get('projectId');
        $project =  Project::where('_id', '=', $id)->first();

        //for project inesrt project score in document
        $projectScore = [
            'recommendationBreakdown' => [
                'allow' => 0,
                'flag' => 0,
                'block' => 0
            ],
            'riskLevelBreakdown' => [
                'veryLow' => 0,
                'low' => 0,
                'mediumLow' => 0,
                'medium' => 0,
                'high' => 0,
                'veryHigh' => 0
            ],
            'countryAndPhoneType' => []
        ];
        $countryAndPhoneType = [];

        $curl = curl_init();
        foreach ($project['numbers'] as $row){
            $numberId = $row['_id']->__toString();
            $number = $row['number'];

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://rest-ww.telesign.com/v1/score/".$number,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "account_lifecycle_event=create&request_risk_insights=true",
                CURLOPT_HTTPHEADER => [
                    "accept: */*",
                    "authorization: Basic NzgxOEExMTQtQ0ZDRC00OTk3LUEwRkMtNTAxMUE1NzhFMkEwOndPTmlqeFVTQmtZRzNzYzRCd2VuUFJ3bDdJc0UxUVNCRzBkQkFOSHNHUWFIc2VtNnM2TnhCMG5CQXBiaXpnSkpBdzVPMnE4cGFtYU5ZaGFVVzZFeDFRPT0=",
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);

            $apiResult = json_decode(curl_exec($curl));
            $err = curl_error($curl);

            if ($err) {
                return dd($err);
            }

            $numberScore = [
                "score" => $apiResult->risk->score,
                "type" => $apiResult->phone_type->description,
                "country" => $apiResult->location->country->name,
                "countryIso" => $apiResult->location->country->iso2,
                "carrierName" => $apiResult->carrier->name,
                "riskLevel" => $apiResult->risk->level,
                "recommendation" => $apiResult->risk->recommendation,
                "riskInsights" => $apiResult->risk_insights
            ];

            switch ($apiResult->risk->level){
                case "very_low":
                    $projectScore['riskLevelBreakdown']['veryLow']++;
                    break;
                case "low":
                    $projectScore['riskLevelBreakdown']['low']++;
                    break;
                case "medium_low":
                    $projectScore['riskLevelBreakdown']['mediumLow']++;
                    break;
                case "medium":
                    $projectScore['riskLevelBreakdown']['medium']++;
                    break;
                case "high":
                    $projectScore['riskLevelBreakdown']['high']++;
                    break;
                case "very_high":
                    $projectScore['riskLevelBreakdown']['veryHigh']++;
                    break;
                default:
                    break;
            }

            $countryIso = $apiResult->location->country->iso2;
            $typeOfNumber = $apiResult->phone_type->description;

            if(!isset($countryAndPhoneType[$countryIso])){
                var_dump('test');
                $newCountryObj = [
                    'countryCode' => $countryIso,
                    'countryName' => $apiResult->location->country->name,
                    'numberOfNumbers' => 0,
                    'scores' => [],
                    'numbers' => []
                ];
                $countryAndPhoneType[$countryIso] = $newCountryObj;
            }
            $countryAndPhoneType[$countryIso]['numberOfNumbers']+=1;
            $countryAndPhoneType[$countryIso]['numbers'][] = $numberId;

            if(!isset($countryAndPhoneType[$countryIso]['scores'][$typeOfNumber])){
                $newTypeOfNumberObj = [
                    'type' => $typeOfNumber,
                    'allow' => 0,
                    'flag' => 0,
                    'block' => 0
                ];
                $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber] = $newTypeOfNumberObj;
            }
            switch ($apiResult->risk->recommendation) {
                case "allow":
                    $projectScore['recommendationBreakdown']['allow']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['allow']++;
                    break;
                case "flag":
                    $projectScore['recommendationBreakdown']['flag']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['flag']++;
                    break;
                case "block":
                    $projectScore['recommendationBreakdown']['block']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['block']++;
                    break;
                default:
                    break;
            }

            Project::where('_id','=',$id)
                ->where('numbers._id','=',$numberId)
                ->update([
                    'numbers.$[].scores' => $numberScore
                ]);
        }

        $projectScore['countryAndPhoneType'] = $countryAndPhoneType;

        curl_close($curl);

        $updateProjectScore = Project::where('_id', '=', $id)->update($projectScore);
        return dd($updateProjectScore);
    }

    public function getScoreForNumber(Request $request){
        $validator = Validator::make($request->all(), [
            'numberId' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errorCode' => 1,
                'errorMsg' => 'Some error occurred!'
            ]);
        }

        $numberId = $request->get('numberId');

        $response = Number::where('_id','=',$numberId)
            ->first();

        if($response){
            return response()->json(array([$response]), 200);
        }
        else{
            return response()->json(array(['msg'=> "Some error occurred!", 'error' => $response]), 500);
        }
    }

    public function getCodes(Request $request){
        $validator = Validator::make($request->all(), [
            'codes' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'errorCode' => 1,
                'errorMsg' => 'Some error occurred!'
            ]);
        }

        $codes = $request->get('codes');

        $data = [];

        foreach($codes as $code){
            $response = Codes::where('code','=', $code)->first();
            if($response){
                $obj = [
                    $response->trafficType,
                    $response->code,
                    "<p class='oneNumberCapitalize'>".$response->name."</p>",
                    $response->risk == true ? "<i class='ph-x-circle text-danger ph-2x'></i>" : "",
                    $response->trust == true ? "<i class='ph-check-circle text-success ph-2x'></i>" : "" ,
                    "<a href='#' onclick='showReadMore(`".$response->readMore."`)'><i class='ph-book-open ph-2x text-primary'></i></a>",
                ];

                $data[] = $obj;
            }
            else{
                return response()->json(array(['msg'=> "Some error occurred!", 'error' => $response]), 500);
            }
        }

        return response()->json(array([$data]), 200);

    }


    public function scoreNumbersTimeTesting(Request $request){
        set_time_limit(0);
        //score numbers for this project
        $id = $request->get('projectId');
        $project =  Project::where('_id', '=', $id)->first();
        $numbers = Number::where('projectId', '=', $id)->get();

        //for project inesrt project score in document
        $projectScore = [
            'recommendationBreakdown' => [
                'allow' => 0,
                'flag' => 0,
                'block' => 0
            ],
            'riskLevelBreakdown' => [
                'veryLow' => 0,
                'low' => 0,
                'mediumLow' => 0,
                'medium' => 0,
                'high' => 0,
                'veryHigh' => 0
            ],
            'countryAndPhoneType' => []
        ];
        $countryAndPhoneType = [];

        $curl = curl_init();

        $test = [];

        foreach ($numbers as $row){
            $numberId = $row['_id'];
            $number = $row['number'];

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://rest-ww.telesign.com/v1/score/".$number,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "account_lifecycle_event=create&request_risk_insights=true",
                CURLOPT_HTTPHEADER => [
                    "accept: */*",
                    "authorization: Basic NzgxOEExMTQtQ0ZDRC00OTk3LUEwRkMtNTAxMUE1NzhFMkEwOndPTmlqeFVTQmtZRzNzYzRCd2VuUFJ3bDdJc0UxUVNCRzBkQkFOSHNHUWFIc2VtNnM2TnhCMG5CQXBiaXpnSkpBdzVPMnE4cGFtYU5ZaGFVVzZFeDFRPT0=",
                    "content-type: application/x-www-form-urlencoded"
                ],
            ]);

            $apiResult = json_decode(curl_exec($curl));
            $err = curl_error($curl);

            if ($err) {
                return dd($err);
            }

            $numberScore = [
                "score" => $apiResult->risk->score,
                "type" => $apiResult->phone_type->description,
                "country" => $apiResult->location->country->name,
                "countryIso" => $apiResult->location->country->iso2,
                "carrierName" => $apiResult->carrier->name,
                "riskLevel" => $apiResult->risk->level,
                "recommendation" => $apiResult->risk->recommendation,
                "riskInsights" => $apiResult->risk_insights
            ];

            Number::where('_id', '=', $numberId)->update([
                'scores' => $numberScore
            ]);

            switch ($apiResult->risk->level){
                case "very_low":
                    $projectScore['riskLevelBreakdown']['veryLow']++;
                    break;
                case "low":
                    $projectScore['riskLevelBreakdown']['low']++;
                    break;
                case "medium_low":
                    $projectScore['riskLevelBreakdown']['mediumLow']++;
                    break;
                case "medium":
                    $projectScore['riskLevelBreakdown']['medium']++;
                    break;
                case "high":
                    $projectScore['riskLevelBreakdown']['high']++;
                    break;
                case "very_high":
                    $projectScore['riskLevelBreakdown']['veryHigh']++;
                    break;
                default:
                    break;
            }

            $countryIso = $apiResult->location->country->iso2;
            $typeOfNumber = $apiResult->phone_type->description;

            if(!isset($countryAndPhoneType[$countryIso])){
                $newCountryObj = [
                    'countryCode' => $countryIso,
                    'countryName' => $apiResult->location->country->name,
                    'numberOfNumbers' => 0,
                    'scores' => [],
                    'numbers' => []
                ];
                $countryAndPhoneType[$countryIso] = $newCountryObj;
            }
            $countryAndPhoneType[$countryIso]['numberOfNumbers']+=1;
            $countryAndPhoneType[$countryIso]['numbers'][] = $numberId;

            if(!isset($countryAndPhoneType[$countryIso]['scores'][$typeOfNumber])){
                $newTypeOfNumberObj = [
                    'type' => $typeOfNumber,
                    'allow' => 0,
                    'flag' => 0,
                    'block' => 0
                ];
                $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber] = $newTypeOfNumberObj;
            }
            switch ($apiResult->risk->recommendation) {
                case "allow":
                    $projectScore['recommendationBreakdown']['allow']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['allow']++;
                    break;
                case "flag":
                    $projectScore['recommendationBreakdown']['flag']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['flag']++;
                    break;
                case "block":
                    $projectScore['recommendationBreakdown']['block']++;
                    $countryAndPhoneType[$countryIso]['scores'][$typeOfNumber]['block']++;
                    break;
                default:
                    break;
            }
        }
        curl_close($curl);

        $projectScore['countryAndPhoneType'] = $countryAndPhoneType;

        $project->update([
            'projectScore' => $projectScore
        ]);
        return redirect()->back();
    }








    public function deleteProjects(){
        Project::query()->delete();
        return redirect('/home2');
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
