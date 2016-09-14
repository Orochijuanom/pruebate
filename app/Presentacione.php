<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacione extends Model
{
    protected $table = 'presentaciones';

    protected $fillable = ['user_id', 'evaluacione_id'];

    public function user(){
        return this->belongsTo('App\User');
    }

    public function evaluacione(){
        return $this->belongsTo('App\Evaluacione');
    }

    public function preguntas(){
        return $this->belongsToMany('App\Pregunta');
    }
}
