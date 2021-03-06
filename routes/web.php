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

Route::get('/acercade',function(){
    return view('acercade');
});

Route::get('politicas', function(){
    return view('politicas');
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
        $grado = App\Asignacione::find($id);
        $evaluaciones = App\Evaluacione::where('asignacione_id','=',$id)->get();
        return view('docente.evaluacion')                    
                    ->with('grado',$grado)
                    ->with('evaluaciones',$evaluaciones);
    });

    Route::get('/docente/evaluacion/presentacion_estud/{id}', function($id){
        //$competencias = App\Pregunta::where('evaluacione_id','=',$evaluacione_id)->select('competencia_id')->groupBy('competencia_id')->get();
        $evaluacion = App\Evaluacione::find($id);
        $estudiantes = App\Presentacione::where('evaluacione_id','=',$id)
                                        ->where('estado','=','1')
                                        ->select('evaluacione_id','user_id')
                                        ->groupBy('user_id')
                                        ->groupBy('evaluacione_id')->get();
        
        return view('docente.estudiantes')
            ->with('estudiantes', $estudiantes)
            ->with('evaluacion',$evaluacion);
    });

   
    
    Route::get('/docente/evaluacion/definicion/{id}', function($id){
        $preguntas = App\Pregunta::where('evaluacione_id','=',$id)->get();
        $asignaciones = App\Evaluacione::find($id)->asignacione()->with('estandares')->first();
        $competencias = array();
        foreach($asignaciones->estandares as $estandare){
            foreach($estandare->competencias as $competencia){
                $competencias[] = $competencia; 

            }

        }
        
        return view('docente.definicion')
                        ->with('id', $id)
                        ->with('preguntas',$preguntas)
                        ->with('competencias',$competencias);
    });

    Route::get('/docente/crear_evaluacion/{id}', function($id){
        
        return view('docente.crear_evaluacion')
                ->with('id', $id);
                
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

    Route::get('/docente/estandares/{id}', function($id) {
        $estandare = App\Estandare::find($id);
        return view('docente.estandares_edit')->withEstandare($estandare);
    });

    Route::put('/docente/estandares/{id}', 'DocenteController@updateEstandar');

    Route::get('/docente/estandares/definicion/{id}', function($id){
        $estandare = App\Estandare::find($id);
        return view('docente.competencias')
            ->with('estandar', $estandare);
    });

    Route::get('/docente/estandares/competencias/{id}', function($id) {
        $compentencia = App\Competencia::find($id);
        return view('docente.competencias_edit')->withCompetencia($compentencia);
    });

    Route::put('/docente/estandares/competencias/{id}','DocenteController@updateCompetencias');


    Route::get('/docente/evaluacion/presentacion_estud/{evaluacione_id}/{user_id}', function($evaluacione_id, $user_id) {
        $limite = 0;
        $intentos = 0;
        $presentacione = null;
        $evaluacione  = App\Evaluacione::where('id', '=', $evaluacione_id)->with('asignacione')->first();
        $preguntas = App\Evaluacione::find($evaluacione_id)->preguntas()->paginate(5);
                                
        $intentos = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', $user_id)->where('estado', '=', '1')->count();
        $presentacione = $presentacione = App\Presentacione::where('evaluacione_id', '=', $evaluacione->id)->where('user_id', '=', $user_id)->where('estado', '=', '1')->orderBy('created_at', 'desc')->with('preguntas')->first();

        if(!$presentacione){
            //FLASH
        }else{
            return view('docente.evaluacion_resultado')->withEvaluacione($evaluacione)->withPreguntas($preguntas)->withPresentacione($presentacione)->withErrors(['message' => 'Ha utilizado '.$intentos.' intentos para presentar su prueba de los '.$evaluacione->intentos.' que tiene disponibles'])->withLimite($limite)->withIntentos($intentos);
        }
    });

    Route::get('/docente/index_evaluacion/{evaluacione}/{grado}/resultados', function($evaluacione_id, $grado_id) {
        $evaluacione = App\Evaluacione::where('id', '=', $evaluacione_id)->with('preguntas')->first();
        $grado = App\Grado::find($grado_id);
        $users = App\Grado::find($grado_id)->users()->with('presentaciones')->get();
        
        $total_preguntas = count($evaluacione->preguntas);
        $datos = array();
        foreach($users as $user){
            $presentacione = $user->presentaciones->where('estado', '=', '1')->where('evaluacione_id', '=', $evaluacione_id)->last();
            $aciertos = 0;
            if($presentacione != null && $presentacione->estado == 1){
                foreach($presentacione->preguntas as $pregunta){
                    foreach($evaluacione->preguntas as $respuesta){
                        if($respuesta->id == $pregunta->id && $respuesta->respuesta == $pregunta->pivot->respuesta){
                           $aciertos++;
                           
                           }
                        }
                    }
                    $porcentaje = $aciertos * 100 / $total_preguntas;
                    $datos[$user->id] = array('nombre' => $user->name, 'aciertos' => $aciertos, 'total' => $total_preguntas, 'porcentaje' => round($porcentaje,2));
                    
                    }else{
                        $porcentaje = $aciertos * 100 / $total_preguntas;
                        $datos[$user->id] = array('nombre' => $user->name, 'aciertos' => $aciertos, 'total' => $total_preguntas, 'porcentaje' => round($porcentaje,2));
                        
                        }
            

        }
        return view('docente.resultados_grupo')->withGrado($grado)->withEvaluacione($evaluacione)->withDatos($datos);
        
    });


    Route::get('/docente/evaluacion/reporte/{evaluacione_id}', function($evaluacione_id){
        $competencias = App\Pregunta::where('evaluacione_id','=',$evaluacione_id)->select('competencia_id')->groupBy('competencia_id')->get();
        
        $datos = array();
        foreach($competencias as $competencia)
        {            
            $co = App\Competencia::where('id','=',$competencia['attributes']['competencia_id'])->first();            
            $preguntas = App\Pregunta::where('evaluacione_id','=',$evaluacione_id)
                        ->where('competencia_id','=',$co['attributes']['id'])->get();
            $preg = array();            
            foreach($preguntas as $pregunta)
            {
                $respuestas = App\PreguntaPresentacione::where('pregunta_id','=',$pregunta['attributes']['id'])->get();
                $correctas = 0;
                $errores = 0;
                foreach($respuestas as $respuesta){
                    if($respuesta['attributes']['respuesta'] === $pregunta['attributes']['respuesta'])
                        $correctas++;
                    else
                        $errores++;    
                }
                $preg[] = array('pregunta' => $pregunta['attributes']['descripcion'], 'respestas' => array('correctas' => $correctas, 'errores' => $errores));
            }
                                    
           $datos[] = array('competencia' => $co['attributes']['descripcion'],'preguntas' => $preg); 
            
        }
        
        return view('docente.reporte_evaluacion')
            ->with('datos',$datos);
    });

    Route::get('docente/evaluacion/edit/{id}', function($id) {
        $evaluacione = App\Evaluacione::find($id);
        return view('docente.editar_evaluacion')->withEvaluacione($evaluacione);
    });

    Route::put('docente/evaluacion/edit/{id}', 'DocenteController@updateEvaluacion');

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
    Route::get('reportes/grados/{id}/d_estudiantes', 'ReportController@estudiantes_grado');

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

    Route::get('administrador/grados/{id}/estudiantes', function($id) {
        $grado = App\Grado::find($id);
        return view('administrador.grados_estudiantes')->withGrado($grado);
    });
    

    Route::put('administrador/grados/{id}/estudiantes', 'AdministradorController@storeEstudiante');

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

    Route::get('administrador/asignaciones/{id}', function($id) {
        $asignacione = App\Asignacione::find($id);
        $users = App\User::where('role_id', '=', '2')->get();
        $materias = App\Materia::all();
        $grados = App\Grado::all();
        return view('administrador.asignaciones_edit')->with(['users' => $users, 'grados' => $grados, 'materias' => $materias, 'asignacione' => $asignacione]);
    });

    Route::put('administrador/asignaciones/{id}', 'AdministradorController@updateAsignacione');

    Route::get('/administrador/usuarios', function(){
        $usuarios = App\User::paginate(10);
        return view('administrador.usuarios')
            ->with('usuarios',$usuarios);
    });

    Route::get('administrador/logs', function() {
        $logs = App\Log::paginate(10);
        return view('administrador.logs')->withLogs($logs);
    });

    

});
/** RUTAS ESTUDIANTE **/
Route::group(['middleware' => 'auth','middleware' => 'estudiante'], function () {
    Route::get('/estudiante/', function() {
        
        $user_id = Auth::user()->id;
        $grado = App\User::find($user_id)->grados()->where('grado_user.anio', '=', date('Y'))->first();
        $asignaciones = App\Grado::find($grado->id)->asignaciones()->with('materia')->with('evaluaciones')->get();
        
        return view('estudiante.index')->withAsignaciones($asignaciones); 
        
           
    });

    Route::get('estudiante/evaluacion/{id}/{new?}', function($id, $new = null) {
        $limite = 0;
        $intentos = 0;
        $presentacione = null;
        $evaluacione  = App\Evaluacione::where('id', '=', $id)->with('asignacione')->first();
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

