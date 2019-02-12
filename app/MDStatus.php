<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MDStatus extends Model
{
    protected $table = 'md_status';
    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function reportactivities(){
        return $this->hasMany(ReportActivity::class);
    }
}
