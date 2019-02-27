<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\MDStatus;
use App\ProjectFile;
use App\ProjectMember;
use App\ReportActivity;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $projects=DB::table('projects')
                ->join('projects','projects.id','=','project_member','project_member.project_id')
                ->select('projects.*')
                ->where('project_member.user_id', Auth::user()->id)
                ->get();
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = MDStatus::all();
        $user=User::all();
        $project=Project::all();
        return view('projects.create', compact('user','status','project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:5',
            'description' => 'required|min:7',
            'url'=> 'required|min:10',
            'start_date' => 'required',
            'status' => 'required',
            
        ]);
        
        $project = Project::create($request->all());

        foreach($request->user_id as $projectmember) {
            
            $dxx = ProjectMember::create([
                'user_id' => $projectmember,
                'project_id' => $project->id
                ]);
        }
       
        return redirect()->route('project.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $projects = Project::all();
        $projectmember = DB::table('project_member')
        ->join('users', 'users.id', '=', 'project_member.user_id')
        ->join('projects', 'projects.id', '=', 'project_member.project_id')
        ->select('users.name', 'users.email')
        ->where('project_member.project_id', $id)
        ->get();
        $pff = ProjectFile::all();
        $projectfile = DB::table('project_file')->where('project_id',$id)->get();
        

        
       return view('projects.detail', compact('projectmember', 'project','projectfile','pff','projects'));
    //    return compact('projectmember');
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = MDStatus::all();
        // $statusid = MDStatus::select('id');
        $user=User::all();
        $project=Project::findOrFail($id);
       
        $projectmember =  DB::table('project_member')->select('user_id as user_id')->where('project_id',$id)->get();
        // var_dump($projectmember);
        $projectMember = [];
        foreach($project->projectmembers as $member) {
            array_push($projectMember, $member->user_id);
        } 
        $project->member = $projectMember;

        // return $project;

        return view('projects.edit', compact('project','status','user','projectmember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $this->validate($request,[
            
            'name' => 'required|min:5',
            'description' => 'required|min:7',
            'url'=> 'required|min:10',
            'status' => 'required',
            
        ]);
        
        $project = Project::findOrFail($id);
        $User = User::All();
        $newProjectMember = $request->user_id;
        
        $oldProjectMember = [];
        foreach (ProjectMember::where('project_id', $id)->get() as $member) {
            array_push($oldProjectMember, $member->user_id);
        } 

        // return [$newProjectMember, $oldProjectMember];

        foreach($request->user_id as $projectmember) {
            if(!in_array($projectmember, $oldProjectMember)) { 
                ProjectMember::create([
                'user_id' => $projectmember,
                'project_id' => $project->id
                ]);
            }
        }
        foreach($oldProjectMember as $projectmember) {
            if(!in_array($projectmember, $newProjectMember)) { 
                ProjectMember::where('user_id', $projectmember)->where('project_id', $id)->delete();
            }
        }

        // foreach($request->user_id as $projectmember) {
        //     if(ProjectMember::where('user_id',$request->user_id)->where('project_id', $id)->count() == 0 ){
                
        //         ProjectMember::create([
        //             'user_id' => $projectmember,
        //             'project_id' => $project->id
        //             ]);
        //     }
        // }


        
        return redirect()->route('project.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
       

        if (ProjectFile::where('project_id', $id)->exists())
        {
            $projectmember = ProjectMember::select('*')->where('project_id', $id)->get();
            // $projectmemberid = $projectmember->project_id;
            foreach ($projectmember as $pmid ){
                $pmid->delete();
            }
           
        }
        
        if (ProjectFile::where('project_id', $id)->exists()){
        // if ($projectfile->exists()){

            $projectfile = ProjectFile::select('*')->where('project_id', $id)->get();
            // $projectfileid = $projectfile->project_id;
            foreach($projectfile as $pfid){
                $pfid->delete();
            }
            
        }

        if (ReportActivity::where('project_id', $id)->exists()){
        // if ($reportactivity->exists()){
        
            $reportactivity = ReportActivity::select('*')->where('project_id', $id)->get();
            // $reportactivityid = $reportactivity->project;
            foreach($reportactivity as $raid){
                $raid->delete();
            }
            
        }

        $project->delete();
        
        return redirect()->route('project.index');
    }
}
