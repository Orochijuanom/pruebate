@extends('layouts.docente')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Panel de gestión administracion</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/usuarios.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Estandares y competencias</h3>
                        <p>Permite el administración de los estandares</p>
                        <p>
                            <a href="/docente/estandares" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

             <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/grados.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Evaluaciones</h3>
                        <p>Permite administrar las evaluaciones</p>
                        <p>
                            <a href="/docente/index_evaluacion" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</div>

@endsection