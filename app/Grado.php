<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    
    protected $table = 'grados';

    protected $fillable = ['descripcion'];

    public function asignaciones(){
        return $this->hasMany('App\Asignacione');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    
}
