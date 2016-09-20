<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Grado;

use App\Http\Requests;
use Redirect;

class AdministradorController extends Controller
{
    public function editDocente($id)
    {
        dd('aca debo hacer que se puedan editar los docentes');
    }

    public function storeGrado(Request $request){
        
        $this->validate($request,[

            'descripcion' => 'required|min:4|max:255',
            
            ]);

        try {
            
            $grado = Grado::create([

            'descripcion' => $request['descripcion']

            ]);
            
            
        }catch (\PDOException $exception) {
            
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }
        
        return Redirect::back() -> with('message', 'Grado guardado');

    }
}
