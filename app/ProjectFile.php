<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $table = 'project_file';
    protected $fillable = [
        'name', 'description', 'filename','upload_by', 'project_id','related_by',
    ];

    public function projectsid()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relates()
    {
        return $this->belongsTo(ProjectFile::class, 'name');
    }
}
