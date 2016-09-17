@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
  <div class="panel-heading">Panel de gestión docnete</div>
  <div class="panel-body">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{asset('img/evaluacion.png')}}" alt="..."/>
                <div class="caption">
                    <h3>Evaluación</h3>
                    <p>Configura las evaluaciones de los diferentes cursos</p>
                    <p>
                        <a href="/docente/create_evaluacion" class="btn btn-primary" role="button">Entrar</a> 
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
  </div>
</div>
@endsection