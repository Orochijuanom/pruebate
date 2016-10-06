@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/docente/">Inicio</a></li>
        <li class="active">Asignaciones</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión evaluación</div>
        <div class="panel-body">
            @if(count($estudiantes)>0)
                <div class="alert alert-success" role="alert">Los cursos asignados</div>
                <table class="table table-bordered">  
                    <thead>
                        <th>N.</th>
                        <th>Grado</th>
                        <th>Materia</th>
                        <th>Opciones</th>
                    </thead>  
                    <tbody>
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td scope="row">1</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="/docente/evaluacion/{{$grado->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a href="/docente/index_evaluacion/estudiantes/{{$grado->id}}"><i class="fa fa-users" aria-hidden="true"></i></a>
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