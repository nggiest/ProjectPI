<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReportActivity;
use App\User;

class Report extends Model
{
    protected $fillable = ['date', 'user'];

    public $timestamps = true;

    protected $table='reports';

    public function hasUser()
    {
        return $this->hasOne('App\User', 'user');
    }

    function getHariIniAttribute() {
        return \Carbon::now()->format('d-m-Y i');
    }

    public function activities(){
        return $this->hasMany('App\ReportActivity', 'report_id', 'id');
    }
}
