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
use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $report = Report::select('*')->where('user', Auth::user()->id)->get();
       //    $reportcount = ReportActivity::selectRaw('count(report_id)')->groupBy('report_id')->where('report_id', $reports->id)->first(); 
    
        foreach ($report as $reports) {
            $reports->repact = ReportActivity::where('report_id',$reports->id)->get();
            // $reports->repact = ReportActivity::all();
            $reports->reportcount = DB::table('reportactivity')->select(DB::Raw('count(report_id) as countid'))->groupBy('report_id')->where('report_id', $reports->id)->first(); 
    //    }
    // }

    // catch(ModelNotFoundException $e) {
    //     foreach ($report as $reports) {
    //         $reports->reportcount->countid = 0 ;
    //     }
    }
       return view('reports.index', compact ('report'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report=Report::all();
        $project=DB::table('projects')
                    ->join('project_member', 'project_member.project_id', '=', 'projects.id')
                    ->select('projects.*')
                    ->where('project_member.user_id', Auth::user()->id )
                    ->get();
        $priority = MDPriority::all();
        $status = MDStatus::all();

        return view('reports.create', compact('priority','status', 'project','report'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        DB::beginTransaction();

        try {
            // Interacting with the database
            $report = Report::create([
                'user' => Auth::user()->id,
                'date' => $request['date'],
            ]);
            $id = $report->id;
            $data = [] ;
            foreach($request['activities'] as $repact) {
                array_push($data, 
                        [
                            'project_id' => $repact['project_id'],
                            'report_id' => $report->id,
                            'module' => $repact['module'],
                            'activity' =>  $repact['activity'],
                            'priority' => $repact['priority'],
                            'status' => $repact['status'],
                        ]);
                } 
                ReportActivity::insert($data);
            DB::commit();    // Commiting  ==> There is no problem whatsoever
        } catch (Exception $e) {
            DB::rollback();   // rollbacking  ==> Something went wrong
        }
        Alert::message('Report created successfully','Success');
      }  

      catch(\Illuminate\Database\QueryException $ex){ 
        Alert::error('Report Duplicated', 'Error'); 
        // Note any method of class PDOException can be called on $ex.
      }
        
            
            return redirect('/daily');
   
       
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
        $reports = Report::findOrFail($id);
        $reportactivity = ReportActivity::select('*')->where('report_id', $id)->get();
        $priority = MDPriority::all();
        $projects=DB::table('projects')
                    ->join('project_member', 'project_member.project_id', '=', 'projects.id')
                    ->select('projects.id as id','projects.name as name')
                    ->where('project_member.user_id', Auth::user()->id )
                    ->get();
        $status = MDStatus::all();
        // dd($reports);
        // dd($projects);
        return view('reports.edit', compact('reports','reportactivity','priority','status','projects'));
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
        // return ($request);
       
        DB::beginTransaction();

            try {
                
                $report = Report::findOrFail($id);
                $reportactivity = ReportActivity::select('project_id','report_id','module','activity','priority','status')->where('report_id',$id)->get();
        
                $oldReportActivity = $reportactivity;

                $data = [];
                    foreach($oldReportActivity as $reportact) {
                        ReportActivity::where('report_id',$id)->delete();
                    } 
                            
                    foreach($request['activities'] as $repact) {
                            array_push($data, 
                                    [
                                        'project_id' => $repact['project_id'],
                                        'report_id' => $repact['report_id'],
                                        'module' => $repact['module'],
                                        'activity' =>  $repact['activity'],
                                        'priority' => $repact['priority'],
                                        'status' => $repact['status'],
                                    ]);
                            } 
                            ReportActivity::insert($data);
                    DB::commit();    // Commiting  ==> There is no problem whatsoever
            }
             catch (Exception $e) {
                DB::rollback();   // rollbacking  ==> Something went wrong
            }
            Alert::message('Report update successfully','Success');
           
            return redirect('/daily')->with('status', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        if (ReportActivity::where('report_id',$id)->exists()){

            $reportactivity = ReportActivity::select('*')->where('report_id',$id)->get();;
            // $reportactivityid = $reportactivityid->reports_id;
            foreach($reportactivity as $raid){
                $raid->delete();
            }
            
        }

        $report->delete();
        Alert::message('Report deleted successfully','Success');
        
        return redirect()->route('daily.index');
    }


    public function getData($id)
    {
        $report = Report::findOrFail($id);
        $report->repact = ReportActivity::where('report_id',$id)->get();
        $obj = $report->repact;
        $no = 1;
        foreach($obj as $objs) {
            $objs->priority = $objs->priorities->priority;
            $objs->status = $objs->statuses->name;
            $objs->project_id = $objs->projects->name;
            $objs->id = $no++;
        }
        return json_encode($obj);
        // $report = Report::findOrFail($id);
        // $reportactivity = ReportActivity::where('report_id',$id)->get();

    }
}
