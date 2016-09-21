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

//Route::get('/home', 'HomeController@index');

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

    Route::get('/docente/evaluacion/definicion/{id}', function($id){
        $preguntas = App\Pregunta::where('evaluacione_id','=',$id)->get();
        return view('docente.definicion')
                        ->with('preguntas',$preguntas);
    });

    Route::post('/docente/crear_evaluacion/', 'DocenteController@crear_evaluacion');
    
});
/** RUTAS ADMINISTRADOR **/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/administrador/', function(){
        return view('administrador.index');
    });

    Route::get('/administrador/docentes/', function() {
        //
        $docentes = App\User::where('role_id', '=', '2')->paginate(10);
        return view('administrador.docentes')->with('docentes', $docentes);
    });

    Route::get('administrador/docentes/{id}', function($id) {
        $docente = App\User::find($id);
        return view('administrador.docentes_edit')->with('docente', $docente);
    });

    Route::put('administrador/docentes/{id}', 'AdministradorController@updateDocente');

    Route::get('administrador/grados', function() {
        $grados = App\Grado::all();
        return view('administrador.grados')->with('grados', $grados);
    });
    
    Route::get('administrador/grados/create', function() {
        return view('administrador.grados_create');
    });

    Route::post('administrador/grados', 'AdministradorController@storeGrado');

    Route::get('administrador/grados/{id}', function($id) {
        $grado = App\Grado::find($id);
        return view('administrador.grados_edit')->withGrado($grado);
    });

    Route::put('administrador/grados/{id}', 'AdministradorController@updateGrado');

    Route::get('administrador/asignaciones/', function() {
        $asignaciones = App\Asignacione::with('user')->with('grado')->get();
        return view('administrador.asignaciones')->withAsignaciones($asignaciones);
        
    });

    Route::get('administrador/asignaciones/create', function() {
        $users = App\User::where('role_id', '=', '2')->get();
        $materias = App\Materia::all();
        $grados = App\Grado::all();
        
        return view('administrador.asignaciones_create')->with(['users' => $users, 'grados' => $grados, 'materias' => $materias]);
    });

    Route::post('administrador/asignaciones','AdministradorController@storeAsignacione');
    
});

