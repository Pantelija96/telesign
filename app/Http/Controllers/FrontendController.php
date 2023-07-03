<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Models\Project;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;

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

    public function home($view = 0){
        //view = 0 => grid view
        $this->data['view'] = $view;
        return view('pages.homeProjects', $this->data);
    }

    public function project($id = null){
        $project = new Project();
        if($id == null){
            //new project
            $project->saved = false;
            $project->numbers = [
                [
                    'number' => 11123,
                    'ip' => '1.1.1.1',
                    'email' => 'email1@test.com',
                    '_id' => new ObjectID()
                ],
                [
                    'number' => 22223,
                    'ip' => '2.2.2.2',
                    'email' => '',
                    '_id' => new ObjectID()
                ],
                [
                    'number' => 33323,
                    'ip' => '3.3.3.3',
                    'email' => 'email3@test.com',
                    '_id' => new ObjectID()
                ],
            ];
            $project->save();
            return redirect('/project/'.$project->id);
        }
        else{
            $this->data['project'] = $project->where('_id', $id)->first();
            return view('pages.project', $this->data);
        }
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
