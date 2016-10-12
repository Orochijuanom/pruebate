<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

use App\Evaluacione;
use App\Presentacione;

class EstudianteController extends Controller
{
    public function storeRespuesta($evaluacione_id, Request $request){

        $evaluacione = Evaluacione::find($evaluacione_id);
        
        if($evaluacione->limite < date('Y-m-d h:i:s')){
            return redirect('estudiante/evaluacion/'.$evaluacione->id)->withErrors(['message' => 'Se ha pasado de la fecha limite '.$evaluacione->limite.' para presentar su prueba']);
        }
        $user_id = Auth::user()->id;
        $presentacione = Presentacione::where('user_id', '=', $user_id)->where('evaluacione_id', '=', $evaluacione->id)->where('estado', '=', '0')->orderBy('created_at', 'desc')->first();
        
        if(!$presentacione){
            $count = Presentacione::where('user_id', '=', $user_id)->where('evaluacione_id', '=', $evaluacione->id)->count();
            
            if($count < $evaluacione->intentos){
                $presentacione = Presentacione::create([
                'user_id' => $user_id,
                'evaluacione_id' => $evaluacione->id
                ]);
            }else{
               return redirect('estudiante/evaluacion/'.$evaluacione->id)->withErrors(['message' => 'Se ha pasado del número de intentos '.$evaluacione->intentos.' para presentar su prueba']);
            }
            
        }
        foreach($request->request as $pregunta => $respuesta){
            if(is_numeric($pregunta)){
                $respuesta_guardada = Presentacione::find($presentacione->id)->preguntas()->where('pregunta_id', '=', $pregunta)->first();
                if(!$respuesta_guardada){
                    $presentacione->preguntas()->attach($pregunta, ['respuesta' => $respuesta]);
                }else{
                    $presentacione->preguntas()->updateExistingPivot($pregunta, ['respuesta' => $respuesta]);
                }                         
            }            
        }

        if($request->estado == 0){
            $nextPage = $request->pagina + 1;
            return redirect('estudiante/evaluacion/'.$evaluacione->id.'?page='.$nextPage)->withMessage('Respuestas almacenadas en el sistema');
        }else{
            $presentacione->estado = 1;
            $presentacione->save();
            return redirect('estudiante/evaluacion/'.$evaluacione->id.'?page=1')->withMessage('Evaluación finalizada');
        }
    }
}
