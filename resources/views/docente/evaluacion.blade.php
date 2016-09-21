@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
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
                            <th>Grado</th>
                            <th>Materia</th>
                            <th>Opciones</th>
                        </thead>  
                        <tbody>
                            @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$evaluacion->intentos}}</td>
                                    <td>{{$evaluacion->created_at}}</td>
                                    <td><a href="/docente/evaluacion/definicion/{{$grado->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron evaluaciones creadas</div>
                @endif        

                <a href="/docente/crear_evaluacion/{{$grado->id}}">Crear evaluaciones</a>
             </div>
        </div>
    </div>    
@endsection