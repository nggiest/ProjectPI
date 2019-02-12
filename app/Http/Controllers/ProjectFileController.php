<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectFile;
use App\Project;
use App\User;
use Webpatser\Uuid\Uuid;

class ProjectFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::all();
        $projectfile = ProjectFile::all();
        return view('projects.document', compact ('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:128',
            'file' => 'required|file|mimes:docx,doc,pdf,odt',
            'description' => 'required |max:128',
            
        ]);
        $project = Project::all();
        $uploadedFile = $request->file('file');
        $destinationPath = 'public/files/';   
        $extension =  $uploadedFile->getClientOriginalExtension();
        $filename = Uuid::generate(4).'.'.$extension;    
        $file = ProjectFile::create([
            'name' => $request->name,
            'filename' => $filename,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'upload_by' => $request->upload_by,

          
        ]);
        $uploadedFile->storeAs($destinationPath,$filename);
        return redirect()->route('project.show',$request->project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project= Project::all();
        return view('projects.documentedit', compact('projectfile','project'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectfile = ProjectFile::findOrFail($id);
        $projectid = $projectfile->project_id;
        $projectfile->delete($id );
        
        return redirect('/project'.'/'.$projectid)->with('projectfilestatus', 1);
    }
}
