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
                <div class="alert alert-success" role="alert">Los cursos asignados</div>
                <table class="table table-bordered">  
                    <thead>
                        <th>N.</th>
                        <th>Estudiante</th>
                        <th>Intentos</th>
                        <th>Opciones</th>
                    </thead>  
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td scope="row">1</td>
                                <td>{{$estudiante->name}}</td>
                                <td>{{$estudiante->presentaciones}}</td>                                
                                <td>                                    
                                    <a href="/docente/index_evaluacion/{{$estudiante->id}}/{{$estudiante->presentacio_evaluacion}}"><i class="fa fa-users" aria-hidden="true"></i></a>
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