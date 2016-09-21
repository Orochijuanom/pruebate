<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Evaluacione;

class DocenteController extends Controller
{
    

    public function crear_evaluacion(Request $request){
        $this->validate($request, [
            'asignacione_id' => 'required',
            'intentos' => 'required',
            'created_at' => 'required'
        ]);

        $input = $request->all();        
        Evaluacione::create($input);        
        return redirect()->back()->with('flash_message', 'Se ha creado la evaluación exitosamente');    
    }
    
}
