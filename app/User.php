<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function projectmembers()
    {
        return $this->hasMany(ProjectMember::class);
    }

    public function projectfiles()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
