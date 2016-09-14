<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacione extends Model
{
    protected $table = 'asignaciones';

    protected $fillable = ['grado_id', 'materia_id', 'user_id'];

    public function grado(){
        return $this->belongsTo('App\Grado');
    }

    public function materia(){
        return $this->belongsTo('App\Materia');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
