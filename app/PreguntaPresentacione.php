<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaPresentacione extends Model
{
    protected $table = 'pregunta_presentacione';

    protected $fillable = ['pregunta_id', 'presentacione_id','respuesta'];

    
}
