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
       $reportcount = DB::table('reportactivity')->select(DB::Raw('count(report_id) as countId'))->groupBy('report_id')->get();
       return view('reports.index', compact ('report','reportcount'));
        
    
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
            DB::beginTransaction();

            try {
                // Interacting with the database
                $report = Report::create([
                    'user' => Auth::user()->id,
                    'date' => $request['date'],
                ]);
                $id = $report->id;
                $data = [] ;
                foreach ($request['activities'] as $activity) {
                    array_push($data, 
                        [
                            'project_id' => $activity['project_id'],
                            'report_id' => $id,
                            'module' => $activity['module'],
                            'activity' =>  $activity['activity'],
                            'priority' => $activity['priority'],
                            'status' => $activity['status']
                        ]
                    );           
                }  
                ReportActivity::insert($data);
                DB::commit();    // Commiting  ==> There is no problem whatsoever
            } catch (Exception $e) {
                DB::rollback();   // rollbacking  ==> Something went wrong
            }

       

            return redirect('/daily/create')->with('status', 'Success');
    //    }
    //    return $data;    

       
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
