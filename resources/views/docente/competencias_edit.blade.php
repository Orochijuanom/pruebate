@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/estandares">Estándares</a></li>
      <li><a href="/docente/estandares/definicion/{{$competencia->estandare->id}}">{{$competencia->estandare->descripcion}}</a></li>
      <li class="active">Competencias</li>      
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión administración de estandares</div>
            <div class="panel-body">
                @if (Session::get('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="/docente/estandares/competencias/{{$competencia->id}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <input id="descripcion" value="{{$competencia->descripcion}}" type="text" class="form-control" name="descripcion" required autofocus>                            
                        </div>
                    </div> 
                                  
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Editar Competencia
                            </button>
                        </div>
                    </div>
                </form>

                <br/>
                     
        </div>
 


@endsection