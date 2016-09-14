<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $table = 'competencias';

    protected $fillable = ['descripcion', 'estandare_id', 'competencia_id'];

    public function estandare(){
        return $this->belongsTo('App\Estandare');
    }

    public function asignacione(){
        return $this->belongTo('App\Asignacione');
    }

    public function evaluaciones(){
        $this->belongsToMany('App\Evaluacione');
    }
}
