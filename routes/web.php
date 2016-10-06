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
Route::group(['middleware' => 'auth', 'middleware' => 'docente'], function () {


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
        $competencias = App\Competencia::all();
        return view('docente.crear_evaluacion')
                ->with('id', $id)
                ->with('competencias', $competencias);
    });

    Route::get('/docente/estandares/', function(){
        $estandares = App\Estandare::paginate(10);        
        return view('docente.estandares')
                    ->with('estandares', $estandares);
    });

    Route::get('/docente/crear_estandar', function(){
        $asignaciones = App\Asignacione::where('user_id','=',Auth::user()->id)->get();
        return view('docente.crear_estandar')
                ->with('asignaciones',$asignaciones);
    });

    Route::get('/docente/estandares/definicion/{id}', function($id){
        $estandar = App\Estandare::find($id)->first();
        return view('docente.competencias')
            ->with('estandar', $estandar);
    });

    Route::get('/docente/index_evaluacion/estudiantes/{id}', function($id){
        $estudiantes = App\Grado::find($id)->users()->get();        
        return view('docente.estudiantes')
            ->with('estudiantes',$estudiantes);
    });
    Route::post('/docente/crear_evaluacion/', 'DocenteController@crear_evaluacion');
    Route::post('/docente/definicion/', 'DocenteController@crear_pregunta');
    Route::post('/docente/crear_estandar/', 'DocenteController@crear_estandar');
    Route::post('/docente/estandares/definicion/', 'DocenteController@definir_estandar');
    
    
});
/** RUTAS ADMINISTRADOR **/
Route::group(['middleware' => 'auth', 'middleware' => 'administrador'], function () {


    /** RUTAS REPORTES **/
    Route::get('reportes/logs', 'ReportController@logs');
    Route::get('reportes/docentes', 'ReportController@docentes');
    Route::get('reportes/grados', 'ReportController@grados');
    Route::get('reportes/asignacion', 'ReportController@asignacion');
    Route::get('reportes/usuarios', 'ReportController@usuarios');

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
    Route::get('/administrador/usuarios', function(){
        $usuarios = App\User::paginate(10);
        return view('administrador.usuarios')
            ->with('usuarios',$usuarios);
    });

    Route::get('administrador/logs', function() {
        $logs = App\Log::paginate(10);
        return view('administrador.logs')->withLogs($logs);
    });

    Route::get('administrador/estudiantes', function() {
        return view('administrador.estudiantes');
    });

    Route::post('administrador/estudiantes', 'AdministradorController@storeEstudiante');

});
/** RUTAS ESTUDIANTE **/
Route::group(['middleware' => 'auth','middleware' => 'estudiante'], function () {
    Route::get('/estudiante/', function() {
        
        $user_id = Auth::user()->id;
        $grado = App\User::find($user_id)->grados()->where('grado_user.anio', '=', date('Y'))->firstOrFail();
        $asignaciones = App\Grado::find($grado->id)->asignaciones()->with('materia')->with('evaluaciones')->get();

        return view('estudiante.index')->withAsignaciones($asignaciones);    
    });

    Route::get('estudiante/evaluacion/{id}/{new?}', function($id, $new = null) {
        $limite = 0;
        $intentos = 0;
        $presentacione = null;
        $evaluacione  = App\Evaluacione::find($id)->with('asignacione')->first();
        $preguntas = App\Evaluacione::find($id)->preguntas()->paginate(5);
        
        if(!$new){
            if($evaluacione->limite < date('Y-m-d h:i:s')){
                $presentacione = $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '1')->orderBy('created_at', 'desc')->with('preguntas')->first();
                $limite = 1;
                return view('estudiante.evaluacion_resultado')->withEvaluacione($evaluacione)->withPreguntas($preguntas)->withPresentacione($presentacione)->withErrors(['message' => 'Se ha pasado de la fecha limite '.$evaluacione->limite.' para presentar su prueba'])->withLimite($limite);
            }else{
                $intentos = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '1')->count();
                $presentacione = $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '1')->orderBy('created_at', 'desc')->with('preguntas')->first();

                if(!$presentacione){
                    return redirect('estudiante/evaluacion/'.$evaluacione->id.'/nuevo');
                }else{
                    return view('estudiante.evaluacion_resultado')->withEvaluacione($evaluacione)->withPreguntas($preguntas)->withPresentacione($presentacione)->withErrors(['message' => 'Ha utilizado '.$intentos.' intentos para presentar su prueba de los '.$evaluacione->intentos.' que tiene disponibles'])->withLimite($limite)->withIntentos($intentos);
                }
                
            
            }
            $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '0')->orderBy('created_at', 'desc')->with('preguntas')->first();
            
            if(!$presentacione){
            $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '1')->orderBy('created_at', 'desc')->with('preguntas')->first();
            
            }

        }else{
            $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', Auth::user()->id)->where('estado', '=', '0')->orderBy('created_at', 'desc')->with('preguntas')->first();
            return view('estudiante.evaluacion')->withEvaluacione($evaluacione)->withPreguntas($preguntas)->withPresentacione($presentacione);
    
        }
        

        });

    Route::post('estudiante/evaluacion/{id}/respuestas', 'EstudianteController@storeRespuesta');



});

