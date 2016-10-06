<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Grado;
use App\Asignacione;
use App\User;

use App\Http\Requests;
use Redirect;

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

    public function storeEstudiante(Request $request){
        <?php
 
namespace App\Http\Controllers;
use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
 
class ImportController extends Controller
{
    public function store(Request $request)
    {
 
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        //$nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        //\Storage::disk('local')->put($nombre,  \File::get($file));    
 
        Excel::load($file, function($reader) {
            foreach ($reader->get() as $user) {                
                try {
                    //Creamos el usuario
                    $password = str_random(8);
                    $user = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => bcrypt($password)
                    ]);
 
                    $this->sendEmail($user, $password); // Enviamos el mail
                } catch (Exception $e) {
                    continue;
                }
               
            }
        });
        //return "archivo guardado";
        return User::all();
    }
 
 
    private function sendEmail($user, $password){
        $data = array('email' => $user->email, 'subject' => 'Asignacion de clave', 'body' => $password);
 
        Mail::send('layouts.emails', $data, function ($m) use ($user) {
            $m->from('ajimenez@itfip.edu.co', 'Confirmacion password');
            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
}

    }


}
