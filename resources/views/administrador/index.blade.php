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
                        <h3>Docentes</h3>
                        <p>Permite administrar los docentes de la insitución</p>
                        <p>
                            <a href="/administrador/docentes" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

             <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/grados.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Grados</h3>
                        <p>Permite administrar los grados de la insitución</p>
                        <p>
                            <a href="/administrador/grados" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/asignaciones.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Asignacion Academica</h3>
                        <p>Administra la asignación academica</p>
                        <p>
                            <a href="/administrador/asignaciones" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/logs.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Logs</h3>
                        <p>Transacciones registradas en el sistema</p>
                        <p>
                            <a href="/administrador/logs" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{asset('img/estudiantes.png')}}" alt="..."/>
                    <div class="caption">
                        <h3>Usuarios</h3>
                        <p>Usuarios registrados en el sistema</p>
                        <p>
                            <a href="/administrador/usuarios" class="btn btn-primary" role="button">Entrar</a> 
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>    
</div>

@endsection