@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li class="active">Estándares</li>      
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión administración de estandares</div>
            <div class="panel-body">
                @if (Session::get('flash_message'))
                    <div class="alert alert-success">
                        {{Session::get('flash_message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/docente/estandares/definicion/') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <input id="descripcion" type="text" class="form-control" name="descripcion" required autofocus>                            
                        </div>
                    </div> 
                    <input type="hidden" name="estandare_id" value="{{$estandar->id}}" />               
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Crear Competencia
                            </button>
                        </div>
                    </div>
                </form>

                <hr/>
                @if(count($estandar->competencias)>0)
                    <div class="alert alert-success" role="alert">Las Competencias asociadas</div>
                    <table class="table table-bordered">  
                        <thead>
                            <th>N.</th>
                            <th>Descripción</th>
                            <th>F. Creación</th>                            
                            <th>Opciones</th>
                        </thead>  
                        <tbody>
                            @foreach($estandar->competencias as $competencia)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$competencia->descripcion}}</td>                                    
                                    <td>{{$competencia->created_at}}</td>
                                    <td>                                        
                                        <a href="/docente/estandares/{{$competencia->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                    
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron competencias asociados al estandar</div>
                @endif                                
             </div>            
        </div>
    </div>    


@endsection