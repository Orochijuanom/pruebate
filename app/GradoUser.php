<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoUser extends Model
{
    protected $table = 'grado_user';

    protected $fillable = ['grado_id', 'user_id', 'annio'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function grado(){
        return $this->belongsTo('App\Evaluacione');
    }    
}
