<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    
    protected $table = 'project_member';
    protected $fillable = ['user_id', 'project_id'];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
