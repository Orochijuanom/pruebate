<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/** RUTAS DOCENTE **/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/docente/', function(){
        $grados = App\Asignacione::where('user_id', '=', Auth::user()->id)->get();        
        return view('docente.index')
                    ->with('grados', $grados);
    });

    Route::get('/docente/evaluacion/{id}', function($id){
        $grado = App\Asignacione::find($id)->first();
        $evaluaciones = App\Evaluacione::where('asignacione_id','=',$id)->get();
        return view('docente.evaluacion')
                    ->with('grado',$grado)
                    ->with('evaluaciones',$evaluaciones);
    });

    Route::get('/docente/crear_evaluacion/{id}', function($id){
        return view('docente.crear_evaluacion')
                ->with('id', $id);
    });

    Route::post('/docente/crear_evaluacion/', crear_evaluacion@DocenteController);

});