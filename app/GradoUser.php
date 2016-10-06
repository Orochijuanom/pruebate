<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoUser extends Model
{
    protected $table = 'grado_user';

    public $timestamps = false;

    protected $fillable = ['grado_id', 'user_id', 'anio'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function grado(){
        return $this->belongsTo('App\Grado');
    }    
}
