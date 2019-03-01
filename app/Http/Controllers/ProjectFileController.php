<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectFile;
use App\Project;
use App\User;
use Alert;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
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
        $projectfile = ProjectFile::where('project_id', Input::get('project_id'))->get();
       
        return view('projectfiles.create', compact ('project','projectfile'));
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
        
        // return $request;
        // dd($request);
       
        $project = Project::all();
        $uploadedFile = $request->file('file');
        $destinationPath = ('public/files');   
        $extension =  $uploadedFile->getClientOriginalExtension();
        $filename = Uuid::generate(4).'.'.$extension;    
        $file = ProjectFile::create([
            'name' => $request->name,
            'filename' => $filename,
            'description' => $request->description,
            'upload_by' => $request->upload_by,
            'project_id' => $request->input('project_idx'),
            'related_by' => $request->related_by,
        ]);
       
        // dd($request);
        $uploadedFile->storeAs($destinationPath,$filename);
        // Alert::message('Document added successfully');
        return redirect()->route('project.show', $request->input('project_idx'));
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
        $projectfiles = ProjectFile::findOrFail($id);

        $projfiles = ProjectFile::where('project_id', $projectfiles->project_id)->get();
        // return $projectfiles;
        return view('projectfiles.edit', compact('projectfiles','projfiles'));
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
        $this->validate($request, [
            'name' => 'required|max:128',
            'file' => 'required|file|mimes:docx,doc,pdf,odt',
            'description' => 'required |max:128',
            
        ]);
        
        
        $uploadedFile = $request->file('file');
        $destinationPath = ('public/files');   
        $extension =  $uploadedFile->getClientOriginalExtension();
        $filename = Uuid::generate(4).'.'.$extension;
        $file = ProjectFile::update([
            'name' => $request->input('document_name'),
            'filename' => $filename,
            'description' => $request->description,
            'project_id' => $request->input('project_idx'),
            'upload_by' => $request->upload_by,
            'related_by' => $request->related_by,

          
        ]);
            
        
        $uploadedFile->storeAs($destinationPath,$filename);
        Alert::message('Document update successfully');
        return redirect()->route('project.show', $request->input('project_idx'));
        
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
