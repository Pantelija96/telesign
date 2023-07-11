<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Models\Number;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;
use function PHPUnit\Framework\isEmpty;

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
        $newProjects = [];
        $openedProjects = [];
        $userProjects = User::where('_id', '=', session()->get('user')['_id'])->first()['projects'];
        foreach ($userProjects as $userProject){
            if($userProject["owner"]){
                $openedProjects[] = $userProject;
            }
            else{
                if($userProject["opened"]){
                    $openedProjects[] = $userProject;
                }
                else{
                    $newProjects[] = $userProject;
                }
            }
        }
        $this->data['openedProjects'] = $openedProjects;
        $this->data['newProjects'] = $newProjects;
        $this->data['allProjects'] = $userProjects;
        $this->data['view'] = $view;

//        return dd($this->data);
        return view('pages.homeProjects', $this->data);
    }

    public function project($id = null){
        //return dd(session()->get('user')['_id']);
        $project = new Project();
        if($id == null){
            //new project
            $project->saved = false;
            $project->owner = session()->get('user')['_id'];
            $project->projectScore = [];
            $project->name = "Generic name";
            $project->description = "Generic desc";
            $project->save();
            $projectId = $project->id;
            $obj = [
                "projectId" => $projectId,
                "owner" => true,
                "opened" => true,
                "saved" => false,
                'projectName' => "Generic name",
                'projectDescription' => "Generic description",
                'date' => Carbon::now()->timestamp
            ];
            $user = User::where([
                '_id' => session()->get('user')['_id']
            ])->push('projects', array($obj));

            return redirect('/project/'.$project->id);
        }
        else{
            $this->data['project'] = $project->where('_id', $id)->first();
            $this->data['numbers'] = Number::where('projectId', $id)->get();
            $this->data['scored'] = empty(!$this->data['project']['projectScore']);
            return view('pages.project', $this->data);
        }

//            $project->numbers = [
//                [
//                    'number' => 11123,
//                    'ip' => '1.1.1.1',
//                    'email' => 'email1@test.com',
//                    '_id' => new ObjectID()
//                ],
//                [
//                    'number' => 22223,
//                    'ip' => '2.2.2.2',
//                    'email' => '',
//                    '_id' => new ObjectID()
//                ],
//                [
//                    'number' => 33323,
//                    'ip' => '3.3.3.3',
//                    'email' => 'email3@test.com',
//                    '_id' => new ObjectID()
//                ],
//            ];
    }

    public function profile($id){
        $user = new User();
        $this->data['userData'] = $user->where('_id', $id)->first();
        return view('pages.profileSettings', $this->data);
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
