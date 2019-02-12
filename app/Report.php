<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['date', 'user'];

    public $timestamps = true;

    protected $table='reports';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    function getHariIniAttribute() {
        return \Carbon::now()->format('d-m-Y i');
    }

    public function reportactivity(){
        return $this->belongsTo(ReportActivity::class);
    }
}
