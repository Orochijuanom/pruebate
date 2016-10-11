@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/index_evaluacion">Asignaciones</a></li>
      <li class="active">Evaluaciones</li>      
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">     
                @if(count($evaluaciones)>0)
                    <div class="alert alert-success" role="alert">Las evaluaciones creadas</div>
                    <table class="table table-bordered">  
                        <thead>
                            <th>N.</th>
                            <th>Descripción</th>
                            <th>Intentos</th>
                            <th>F. Presentación</th>
                            <th>Opciones</th>
                        </thead>  
                        <tbody>
                            @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$evaluacion->descripcion}}</td>
                                    <td>{{$evaluacion->intentos}}</td>
                                    <td>{{$evaluacion->created_at}}</td>
                                    <td>

                                        <a href="/docente/evaluacion/definicion/{{$evaluacion->id}}"><i class="fa fa-cogs" aria-hidden="true"></i></a>
                                        <a href="/docente/evaluacion/presentacion_estud/{{$evaluacion->id}}"><i class="fa fa-users" aria-hidden="true"></i></a>
                                        <a href="/docente/index_evaluacion/{{$evaluacion->id}}/{{$grado->grado->id}}/resultados"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>
                                        <a href="/docente/evaluacion/reporte/{{$evaluacion->id}}"><i class="fa fa-wpforms" aria-hidden="true"></i></a>
                                        <!--<a href="/docente/evaluacion/{{$evaluacion->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>-->

                                    </td>
                                    
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron evaluaciones creadas</div>
                @endif        
                
                <a href="/docente/crear_evaluacion/{{$grado->id}}" class="btn btn-default">Crear evaluaciones</a>
             </div>
        </div>
    </div>    
@endsection