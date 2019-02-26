<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    protected $table = 'reportactivity';

    protected $fillable = [
        'project_id','report_id','module','activity','priority', 'status',
    ];
    public function reports(){
        return $this->belongsTo(Report::class,'report_id');
    }

    public function projects(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function priorities(){
        return $this->belongsTo(MDPriority::class,'priority');
    }

    public function statuses(){
        return $this->belongsTo(MDStatus::class,'status');
    }

}
