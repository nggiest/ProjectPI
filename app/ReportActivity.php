<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    protected $table = 'reportactivity';

    protected $fillable = [
        'project_id','report_id','module','activity','priority', 'status',
    ];
    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function priority(){
        return $this->belongsTo(MDPriority::class);
    }

    public function status(){
        return $this->belongsTo(MDStatus::class);
    }

}
