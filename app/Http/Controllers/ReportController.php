<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\ReportActivity;
use App\User;
use App\MDPriority;
use App\Project;
use App\MDStatus;
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
    
        $datecount = DB::table('reports')->selectRaw('date, count(*) as countId')->groupBy('date')->get();
        return view('reports.index', compact ('datecount' ));


    

        
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
       $report = Report::create([
            // 'user' => $request->input('id'),
            'user' => $request->user()['id'],
            'date' => $request['date'],
        ]);

        $ra = ReportActivity::create([
            'project' => $request['project'],
            'report_id' => $report->id,
            'module' => $request['module'],
            'activity' => $request['activity'],
            'priority' => $request['priority'],
            'status' => $request['status'],
        ]);

        return redirect()->route('daily.index');
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
        //
    }
}
