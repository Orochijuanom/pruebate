@extends('layouts.docente')
@section('content')
       <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/evaluacion/{{$evaluacione->id}}">Evaluaciones</a></li>
      <li class="active">Crear Evaluación</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">
            
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::get('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="/docente/evaluacion/edit/{{$evaluacione->id}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{$evaluacione->descripcion}}" required autofocus>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="intentos" class="col-md-4 control-label">Intentos</label>
                        <div class="col-md-6">
                            <input id="intentos" type="text" class="form-control" name="intentos" value="{{$evaluacione->intentos}}" required>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_presentacion" class="col-md-4 control-label">Fecha presentación</label>
                        <div class="col-md-6">
                            <input id="fecha_presentacion" type="datetime-local" class="form-control" name="limite" value="{{ str_replace(' ','T',$evaluacione->limite) }}" required>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="apoyo" class="col-md-4 control-label">Url recurso apoyo</label>
                        <div class="col-md-6">
                            <input id="apoyo" type="text" class="form-control" name="apoyo" value="{{$evaluacione->apoyo}}" required>                            
                        </div>
                    </div>
                    
                    <input type="hidden" name="asignacione_id" value="{{$evaluacione->id}}" />                    
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </form> 
             </div>
        </div>
    </div>    
@endsection
