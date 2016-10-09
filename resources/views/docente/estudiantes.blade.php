@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/docente/">Inicio</a></li>
        <li><a href="docente/index_evaluacion">Asignaciones</a></li>        
        <li class="active">Estudiantes</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión evaluación</div>
        <div class="panel-body">
            @if(count($estudiantes)>0)
                <div class="alert alert-success" role="alert">Estudiantes que presentaron la evaluación</div>
                <table class="table table-bordered">  
                    <thead>
                        <th>N.</th>
                        <th>Estudiante</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                    </thead>  
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td scope="row">1</td>
                                <td>{{$estudiante->user->name}}</td>
                                <td>{{$estudiante->created_at}}</td>                                
                                <td>                                    
                                    <a href="/docente/evaluacion/presentacion_estud/{{$estudiante->evaluacione_id}}/{{$estudiante->user_id}}"><i class="fa fa-wpforms" aria-hidden="true"></i></a>
                                </td>
                                                        
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