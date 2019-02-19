<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\ReportActivity;
use App\User;
use App\MDPriority;
use App\Project;
use App\MDStatus;
use Auth;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $report = Report::all();
       $reportcount = DB::table('reportactivity')->select(DB::Raw('project_id, count(*) as countId'))->groupBy('project_id')->get();
    //    return view('reports.index', compact ('report','reportcount'));

    return $reportcount;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report=Report::all();
        $project=Project::all();
        $priority = MDPriority::all();
        $status = MDStatus::all();
        return view('reports.create', compact('priority','status', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->user);

        // $this->validate($request,[
        //                 'module' => 'required|min:10',
        //                 'activity' => 'required|min:10',
        //                 'project'=> 'required',
        //                 'priority' => 'required',
        //                 'status' => 'required',
        //         ]);
        
    //    if (Report::where('user', $request->user)
    //         ->where('date', $request->date)
    //         ->exists()) {

    //         $errorMessage = "User sudah membuat report!";
    //         return redirect('/daily/create')->with('status', $errorMessage);
    //     }
    
    //    else{

    //     $this->validate($request,[
    //             'module' => 'required|min:10',
    //             'activity' => 'required|min:10',
    //             'priority'=> 'required',
    //             'priority' => 'required',
    //             'status' => 'required',
    //     ]);

        //     $report = Report::create($request->all());

        // //foreach($ as $ra){
            
        //     $ra = new ReportActivity();
        //     $ra->project_id = $request['project'];
        //     $ra->report_id = $report->id;
        //     $ra->module = $request['module'];
        //     $ra->activity = $request['activity'];
        //     $ra->priority = $request['priority'];
        //     $ra->status = $request['status'];
        //     $ra->save();

       // }

    //         return redirect('/daily/create')->with('status', 'Success');
    //    }
       return $request;    

       
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
        //
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
        //p
    }


    public function help($id)
    {

    }
}
