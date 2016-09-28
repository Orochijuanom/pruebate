<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Evaluacione;
use App\Pregunta;
use App\Estandare;
use App\Competencia;

class DocenteController extends Controller
{
    

    public function crear_evaluacion(Request $request){
        $this->validate($request, [
            'descripcion' => 'required',
            'asignacione_id' => 'required',
            'intentos' => 'required',
            'limite' => 'required'
        ]);

        $data = $request->all();        
        $evaluacion = Evaluacione::create($data);
        foreach($request->competencia as $competencia){
            if ($competencia >= 1) $evaluacion->competencias()->attach($competencia);
        }
        
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
        return redirect()->back()->with('message', 'Se ha creado la pregunta exitosamente');    
    }

    public function crear_estandar(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required'
        ]);
        $data = $request->all();
        Estandare::create($data);
        return redirect()->back()->with('flash_message', 'Se ha creado el exitosamente');
    }

    public function definir_estandar(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required',
            'estandare_id' => 'required'
        ]);
        $data = $request->all();
        Competencia::create($data);
        return redirect()->back()->with('flash_message', 'Se ha creado el exitosamente');
    }  
}
