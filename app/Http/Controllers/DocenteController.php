<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DocenteController extends Controller
{
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crear_evaluacion(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'intentos' => 'required',
            'fecha_presentacion' => 'required'
        ]);

        $input = $request->all();
        app\Evaluacione::create($input);
        Session::flash('flash_message', 'Task successfully added!');
        //return redirect()->back();
    }


}
