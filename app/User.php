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
        'name', 'email', 'password', 'role_id',
    ];
    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function asignaciones(){
        return $this->hasMany('App\Asignacione');
    }

    public function presentaciones(){
        return $this->hasMany('App\Presentacione');
    }

    public function grados(){
        return $this->belongsToMany('App\Grado');
    }

    public function logs(){
        return $this->hasMany('App\Log');
    }

    public function gradousers(){
        return $this->hasMany('App\GradoUser');

    }

}
