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
        </div>
    </div>    
</div>

@endsection