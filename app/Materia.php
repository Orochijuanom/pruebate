<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';

    protected $fillable = ['descripcion'];

    public function asignaciones(){
        return $this->hasMany('App\Asignacione');
    }
}
