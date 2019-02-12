<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MDPriority extends Model
{
    protected $table = 'md_priority';
    public function reportactivities(){
        return $this->hasMany(ReportActivity::class);
    }
}
