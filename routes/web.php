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
        return view('docente.index');
    });

    Route::get('/docente/index_evaluacion/', function(){
        $grados = App\Asignacione::where('user_id', '=', Auth::user()->id)->get();        
        return view('docente.index_evaluacion')
                    ->with('grados', $grados);
    });

    Route::get('/docente/evaluacion/{id}', function($id){
        $grado = App\Asignacione::find($id)->first();
        $evaluaciones = App\Evaluacione::where('asignacione_id','=',$id)->get();
        return view('docente.evaluacion')                    
                    ->with('grado',$grado)
                    ->with('evaluaciones',$evaluaciones);
    });
    
    Route::get('/docente/evaluacion/definicion/{id}', function($id){
        $preguntas = App\Pregunta::where('evaluacione_id','=',$id)->get();
        return view('docente.definicion')
                        ->with('id', $id)
                        ->with('preguntas',$preguntas);
    });

    Route::get('/docente/crear_evaluacion/{id}', function($id){
        $estandares = App\Estandare::all();
        return view('docente.crear_evaluacion')
                ->with('id', $id)
                ->with('estandares', $estandares);
    });

    Route::get('/docente/estandares/', function(){
        $estandares = App\Estandare::paginate(10);        
        return view('docente.estandares')
                    ->with('estandares', $estandares);
    });

    Route::get('/docente/crear_estandar', function(){
        return view('docente.crear_estandar');
    });

    Route::get('/docente/estandares/definicion/{id}', function($id){
        $estandar = App\Estandare::find($id)->first();
        return view('docente.competencias')
            ->with('estandar', $estandar);
    });

    Route::post('/docente/crear_evaluacion/', 'DocenteController@crear_evaluacion');
    Route::post('/docente/definicion/', 'DocenteController@crear_pregunta');
    Route::post('/docente/crear_estandar/', 'DocenteController@crear_estandar');
    Route::post('/docente/estandares/definicion/', 'DocenteController@definir_estandar');
    
});
/** RUTAS ADMINISTRADOR **/
Route::group(['middleware' => 'auth', 'middleware' => 'administrador'], function () {
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
        $asignaciones = App\Asignacione::with('user')->with('grado')->paginate(7);
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
/** RUTAS ADMINISTRADOR **/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/estudiante/', function() {
        
        $user_id = Auth::user()->id;
        $grado = App\User::find($user_id)->grados()->where('grado_user.anio', '=', date('Y'))->firstOrFail();
        $asignaciones = App\Grado::find($grado->id)->asignaciones()->with('materia')->with('evaluaciones')->get();

        return view('estudiante.index')->withAsignaciones($asignaciones);    
    });

    Route::get('estudiante/evaluacion/{id}', function($id) {
        $evaluacione  = App\Evaluacione::find($id)->with('asignacione')->first();
        $preguntas = App\Evaluacione::find($id)->preguntas()->paginate(5);
        
        return view('estudiante.evaluacion')->withEvaluacione($evaluacione)->withPreguntas($preguntas);
    });

    Route::post('estudiante/evaluacion/{id}/respuestas', 'EstudianteController@storeRespuesta');
});

