<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estandare extends Model
{
    protected $table = 'estandares';

    protected $fillable = ['descripcion'];

    public function competencias(){
        return $this->hasMany('App\Competencia');
    }
}
