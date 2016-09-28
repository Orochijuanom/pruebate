<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estandare extends Model
{
    protected $table = 'estandares';

    protected $fillable = ['descripcion','asignacione_id'];

    public function competencias(){
        return $this->hasMany('App\Competencia');
    }

    public function asignacione(){
        return $this->belongsTo('App\Asignacione');
    }
}
