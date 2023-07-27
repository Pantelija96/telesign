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

    public function home($view = 0, $status = null){
        $userId = session()->get('user')['_id'];

        $ownedProject = [];
        $seeOnlyProjects = [];

        $projects = Project::where('owner', '=', $userId)
            ->orWhere('saved', '=', true)
            ->get();

        if($view == 0) {
            switch ($status) {
                case "owned":
                    $projects = Project::where('owner', '=', $userId)->get();
                    break;
                case "unsaved":
                    $projects = Project::where('owner', '=', $userId)->where('saved', '=', false)->get();
                    break;
                case "readonly":
                    $projects = Project::where('owner', '!=', $userId)->where('saved', '=', true)->get();
                    break;
                default:
                    $projects = Project::where('owner', '=', $userId)->orWhere('saved', '=', true)->get();
            }
        }


        foreach ($projects as $project){
            if($project->owner === $userId){
                $ownedProject[] = $project;
            }
            else{
                $seeOnlyProjects[] = $project;
            }
        }

        $this->data['ownedProjects'] = $ownedProject;
        $this->data['seeOnlyProjects'] = $seeOnlyProjects;
        $this->data['allProjects'] = $projects;
        $this->data['view'] = $view;
        $this->data['status'] = $status;

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
            $unsavedProj = session()->get('numberOfUnsaved') + 1;
            session()->put('numberOfUnsaved', $unsavedProj);
            return redirect('/project/'.$project->id);
        }
        else{
            $this->data['project'] = $project->where('_id', $id)->first();
            $this->data['numbers'] = Number::where('projectId', $id)->get();
            $this->data['scored'] = empty(!$this->data['project']['projectScore']);
            $this->data['id'] = $id;
            return view('pages.project', $this->data);
        }
    }

    public function roi($id){
        $this->data['id'] = $id;
        return view('pages.roi2', $this->data);
    }

    public function profile($id){
        $user = new User();
        $this->data['userData'] = $user->where('_id', $id)->first();
        return view('pages.profileSettings', $this->data);
    }

    public function openProject($id, $owner){
        $logedUserId = session()->get('user')['_id'];
        if ($owner == $logedUserId){
            return redirect('/project/'.$id);
        }
        else{
            return 'read only';
            $this->data['project'] = $project->where('_id', $id)->first();
            return view('pages.readOnly', $this->data);
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
