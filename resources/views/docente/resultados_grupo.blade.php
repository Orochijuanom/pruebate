@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/docente/">Inicio</a></li>
        <li><a href="docente/index_evaluacion">Asignaciones</a></li>        
        <li class="active">{{$grado->descripcion}}</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión evaluación</div>
        <div class="panel-body">
            @if(count($datos)>0)
                <div class="alert alert-success" role="alert">Resultados para la evaluacion {{$evaluacione->descripcion}} para el grado {{$grado->descripcion}}</div>
                <table class="table table-bordered">  
                    <thead>
                        <th>N.</th>
                        <th>Estudiante</th>
                        <th>resultado</th>
                    </thead>  
                    <tbody>
                        @foreach($datos as $dato)
                        
                            <tr>
                                <td scope="row">1</td>
                                <td>{{$dato['nombre']}}</td>
                                <td>{{$dato['aciertos']}}/{{$dato['total']}}</td>                                
                                
                                                        
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning" role="alert">No se encontraron asignaciones para usted</div>
            @endif        
        </div>
    </div>        
@endsection