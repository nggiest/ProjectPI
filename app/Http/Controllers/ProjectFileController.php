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
        // return $request;
        // $this->validate($request, [
        //     'name' => 'required|max:128',
        //     'file' => 'required|file|mimes:docx,doc,pdf,odt',
        //     'description' => 'required |max:128',
            
        // ]);
        
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
            
            return $request->related_by;
        // return $request;
        $uploadedFile->storeAs($destinationPath,$filename);
        Alert::message('Document added successfully','Success');
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
        $file= ProjectFile::findOrFail($id);
        $list = ProjectFile::where('project_id', $file->project_id)->get();

        //dd($file->related_by);
        return view('projectfiles.edit', compact('file','list'));
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
        // $this->validate($request, [
        //     'name' => 'required|max:128',
        //     'description' => 'required |max:128',
            
        //     ]);
            
            // $file = ProjectFile::findOrFail($id);
            
            $file = ProjectFile::findOrFail($id);
            // return $file;
        
        // return $request;
        $file->name = $request->document_name;
        $file->description = $request->description;
        $file->project_id = $request->input('project_idx');
        $file->upload_by = $request->upload_by;
        $file->related_by = null;
        $file->save();

        // dd($request);
            
        if (empty($request->file('file'))){
            $file->filename = $file->filename;
        }
        else{
            // unlink('public/files'.$file->filename); //menghapus file lama
            $uploadedFile = $request->file('file');
            $destinationPath = ('public/files');   
            $extension =  $uploadedFile->getClientOriginalExtension();
            $filename = Uuid::generate(4).'.'.$extension;
            $uploadedFile->storeAs($destinationPath,$filename);
            $file->filename = $filename;
        }
        $file->save();
        Alert::message('Document update successfully','Success');
        // dd($request);
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
        // return $id;
        $projectfile = ProjectFile::findOrFail($id);
        $projectid = $projectfile->project_id;
        $projectfile->delete($id );
        
        Alert::message('Document deleted successfully','Success');
        
        return redirect('/project'.'/'.$projectid)->with('projectfilestatus', 1);
    }
}
