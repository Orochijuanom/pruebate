@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li class="active">Estándares</li>      
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión administración de estandares</div>
            <div class="panel-body">
                @if(count($estandares)>0)
                    <div class="alert alert-success" role="alert">Las evaluaciones creadas</div>
                    <table class="table table-bordered">  
                        <thead>
                            <th>N.</th>
                            <th>Descripción</th>
                            <th>F. Creación</th>                            
                            <th>Opciones</th>
                        </thead>  
                        <tbody>
                            @foreach($estandares as $estandar)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$estandar->descripcion}}</td>                                    
                                    <td>{{$estandar->created_at}}</td>
                                    <td>
                                        <a href="/docente/estandares/definicion/{{$estandar->id}}"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                        <a href="/docente/estandares/{{$estandar->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                    
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron estandares creados</div>
                @endif        
                
                <a href="/docente/crear_estandar/" class="btn btn-default">Crear estardar</a>
             </div>            
        </div>
    </div>    


@endsection