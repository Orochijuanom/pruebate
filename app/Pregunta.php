<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    protected $fillable = ['evaluacione_id', 'descripcion', 'opa', 'opb', 'opc', 'opd', 'respuesta', 'apoyo'];

    public function evaluacione(){
        return $this->belongsTo('App\Evaluacione');
    }

    public function presentaciones(){
        return $this->belongsToMany('App\Presentacione');
    }
}
