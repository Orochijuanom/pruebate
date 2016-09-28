@extends('layouts.docente')
@section('content')
       <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/estandares/">Estandares</a></li>
      <li class="active">Crear Estandar</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">     
                @if (Session::get('flash_message'))
                    <div class="alert alert-success">
                        {{Session::get('flash_message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/docente/crear_estandar') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <input id="descripcion" type="text" class="form-control" name="descripcion" required autofocus>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Grado</label>
                        <div class="col-md-6">
                            <select id="asignacione" class="form-control" name="asignacione_id">
                                @foreach ($asignaciones as $asignacione)
                                    <option value="{{$asignacione->id}}">{{$asignacione->materia->descripcion}}</option>
                                @endforeach
                            </select>                                                        
                        </div>
                    </div>
                                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Crear Estandar
                            </button>
                        </div>
                    </div>
                </form> 
             </div>
        </div>
    </div>    
@endsection
