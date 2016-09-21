<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Evaluacione;
use App\Pregunta;
class DocenteController extends Controller
{
    

    public function crear_evaluacion(Request $request){
        $this->validate($request, [
            'descripcion' => 'required',
            'asignacione_id' => 'required',
            'intentos' => 'required',
            'created_at' => 'required'
        ]);

        $data = $request->all();        
        Evaluacione::create($data);        
        return redirect()->back()->with('flash_message', 'Se ha creado la evaluación exitosamente');    
    }

    public function crear_pregunta(Request $request){
        $this->validate($request, [
            'descripcion' => 'required',            
            'opa' => 'required',
            'opb' => 'required',
            'opc' => 'required',
            'opd' => 'required',
            'respuesta' => 'required',
            'evaluacione_id' => 'required'
        ]);

        $data = $request->all();
        Pregunta::create($data);
        return redirect()->back()->with('flash_message', 'Se ha creado la pregunta exitosamente');    
    }
    
}
