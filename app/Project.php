<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'url', 'start_date', 'status',
    ];

    public function projectmembers(){
        return $this->hasMany(ProjectMember::class);
    }

    public function projectfiles(){
        return $this->hasMany(ProjectFile::class);
    }

    public function reportactivities(){
        return $this->hasMany(ReportActivity::class);
    }

    public function statuses(){
        return $this->belongsTo(MDStatus::class, 'status');
    }
}
