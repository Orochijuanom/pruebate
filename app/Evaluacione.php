<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacione extends Model
{
    protected $table = 'evaluaciones';

    protected $fillable = ['descripcion', 'intentos', 'limite', 'asignacione_id'];

    public function asignacione(){
        return $this->belongsTo('App\Asignacione');
    }

    public function preguntas(){
        return $this->hasMany('App\Pregunta');
    }

    public function precentaciones(){
        return $this->hasMany('App\Presentacione');
    }

    public function competencias(){
        return $this->belongsToMany('App\Competencia');
    }
}
