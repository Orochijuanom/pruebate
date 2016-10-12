<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Evaluacione;
use App\Pregunta;
use App\Estandare;
use App\Competencia;

use Redirect;

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
        
        return redirect()->back()->with('flash_message', 'Se ha creado la evaluación exitosamente');
        
            
    }

    public function crear_pregunta(Request $request){
        $this->validate($request, [
            'descripcion' => 'required',            
            'opa' => 'required',
            'opb' => 'required',
            'opc' => 'required',
            'opd' => 'required',
            'competencia_id' => 'required',
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

    public function updateEstandar($id, Request $request){
         $this->validate($request, [
            'descripcion' => 'required'
        ]);

        try {
            $estandare = Estandare::find($id);
            $estandare->descripcion = $request->descripcion;
            $estandare->save();

        }catch (\PDOException $exception) {
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('message', 'El estandar ha sido editado');
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

    public function updateCompetencias($id, Request $request){
        $this->validate($request, [
            'descripcion' => 'required',
           
        ]);

        try {
            $competencia = Competencia::find($id);
            $competencia->descripcion = $request->descripcion;
            $competencia->save();

        }catch (\PDOException $exception) {
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('message', 'La competencia ha sido editada');
    }


    public function updateEvaluacion($id, Request $request){
         $this->validate($request, [
            'descripcion' => 'required',
            'intentos' => 'required',
            'limite' => 'required',
            'apoyo' => 'required'
        ]);

        try {
            
            $evaluacion = Evaluacione::find($id);
            $evaluacion->descripcion = $request->descripcion;
            $evaluacion->intentos = $request->intentos;
            $evaluacion->apoyo = $request->apoyo;
            $evaluacion->limite = $request->limite;
            $evaluacion->save();

        }catch (\PDOException $exception) {
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('message', 'La evaluacion ha sido editado');
    }  
}
