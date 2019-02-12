<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\MDStatus;
use App\ProjectFile;
use App\ProjectMember;
use App\ReportActivity;
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
        $status = MDStatus::all();
        $user=User::all();
        $project=Project::all();
        $project = DB::table('projects')->paginate(10);
        return view('projects.index', compact('project'));
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
        // $this->validate($request,[
        //     'name' => 'required|min:5',
        //     'description' => 'required|min:7',
        //     'url'=> 'required|min:10',
        //     'start_date' => 'required',
        //     'status' => 'required',
            
        // ]);
        
        $project = Project::create($request->all());
        // $project = new Project();
        // $project->name = $request['name'];
        // $project->description = $request['description'];
        // $project->url = $request['description'];
        // $project->start_date = $request['start_date'];
        // $project->status = $request['status'];
        // $project->save();
        

        
        // $projectmember = ProjectMember::all();
        // $pm = new ProjectMember();

        foreach($request->user_id as $projectmember) {
            // $pm->user_id = $projectmember;
            // $pm->project_id = $project->id;
            // $pm->create();
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
        $projectmember = DB::table('project_member')
        ->join('users', 'users.id', '=', 'project_member.user_id')
        ->join('projects', 'projects.id', '=', 'project_member.project_id')
        ->select('users.name', 'users.email')
        ->where('project_member.project_id', $id)
        ->get();
        $pff = ProjectFile::all();
        $projectfile = DB::table('project_file')->where('project_id',$id)->get();
        
       return view('projects.detail', compact('projectmember', 'project','projectfile','pff'));
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
        $user=User::all();
        $project=Project::findOrFail($id);
        return view('projects.edit', compact('project','status','user'));
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
        // $this->validate($request,[
            
        //     'name' => 'required|min:5',
        //     'description' => 'required|min:7',
        //     'url'=> 'required|min:10',
        //     'status' => 'required',
            
        // ]);
        
        // $project = Project::findOrFail($id);
        // $project->update($request->all());
        
        // return redirect()->route('project.index');

        return $request;
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
        if (ProjectMember::where('project_id', '=', Input::get('id'))->exists())
        {
            $projectmember = ProjectMember::all();
            $projectmemberid = $projectmember->id;
            foreach ($projectmemberid as $pmid ){
                $pmid->delete();
            }
           
        }
        
        if (ProjectFile::where('project_id', '=', Input::get('id'))->exists()){

            $projectfile = ProjectFile::all();
            $projectfileid = $projectfile->project_id;
            foreach($projectfiledid as $pfid){
                $pfid->delete();
            }
            
        }

        if (ReportActivity::where('project', '=', Input::get('id'))->exists()){

            $reportactivity = ReportActivity::all();
            $reportactivityid = $reportactivityid->project;
            foreach($reportactivityid as $raid){
                $raid->delete();
            }
            
        }

        $project->delete();
        
        return redirect()->route('project.index');
    }
}
