<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Grado;
use App\Asignacione;
use App\User;
use App\GradoUser;

use App\Http\Requests;
use Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdministradorController extends Controller
{
    public function updateDocente($id, Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            
        ]);
        try {
            $docente = User::find($id);
            $docente->name = $request->name;
            $docente->email = $request->email;
            $docente->save();

        }catch (\PDOException $exception) {
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('message', 'El docente ha sido editado');
   
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

    public function updateGrado($id, Request $request){
        $this->validate($request, [
            'descripcion' => 'required|max:255',
            
        ]);
        try {
            $grado = Grado::find($id);
            $grado->descripcion = $request->descripcion;
            $grado->save();

        }catch (\PDOException $exception) {
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }

        return Redirect::back() -> with('message', 'El grado ha sido editado');
    }

    public function storeAsignacione(Request $request){

        $this->validate($request,[

            'grado_id' => 'required',
            'materia_id' => 'required',
            'user_id' => 'required'
            
            ]);

        try {
            
            $asignacione = Asignacione::create([

            'grado_id' => $request['grado_id'],
            'materia_id' => $request['materia_id'],
            'user_id' => $request['user_id']

            ]);
            
            
        }catch (\PDOException $exception) {
            
            return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

        }
        
        return Redirect::back() -> with('message', 'el docente'.$asignacione->user->name.' ha sido asignado a la materia '.$asignacione->materia->descripcion.' en el grado '.$asignacione->grado->descripcion);
    }

    public function storeEstudiante($id, Request $request){
        $id = $id;
        
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        //$nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        //\Storage::disk('local')->put($nombre,  \File::get($file));    
 
        Excel::load($file, function($reader)  use($id){
            
            foreach ($reader->get() as $user) {                
                try {
                     
                    $userdb = User::where('email', '=', $user->email)->first();
                    if(!$userdb){
                        
                        $userdb = User::create([
                            'name' => $user->nombre,
                            'email' => $user->email,
                            'role_id' => 3,
                            'password' => bcrypt($user->identidad)
                        ]);
                    }

                    $grado_user = GradoUser::where('user_id', '=', $userdb->id)->where('anio', '=', date('Y'))->first();

                    if(!$grado_user){
                      
                        $grado_user = GradoUser::create([
                            'user_id' => $userdb->id,
                            'grado_id' => $id,
                            'anio' => date('Y')
                        ]);
                    }else{
                        $grado_user->grado_id = $id;
                        $grado_user->save();
                    }
                   
                    
 
                    
                } catch (\PDOException $exception) {
                    return Redirect::back() -> withErrors(['message' => 'Ha ocurrido un error en la consulta '.$exception->getMessage()]);

                }
               
            }
        });
        //return "archivo guardado";
        return Redirect::back() -> with('message', 'Los estudiantes han sido cargados al grado');
    

    }


}
