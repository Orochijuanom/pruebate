@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión [ {{$grado->grado->grados}} - {{$grado->materia->descripcion}} ]</div>
            <div class="panel-body">                
                @if(count($evaluaciones)>0)
                    <div class="alert alert-success" role="alert">Los cursos asignados</div>
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
                                    <td>{{$evaluacion->grado->grados}}</td>
                                    <td>{{$evaluacion->materia->descripcion}}</td>
                                    <td><a href="/docente/evaluacion/definicion/{{$evaluacion->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron asignaciones para usted</div>
                @endif

                <a href="/docente/crear_evaluacion/{{$grado->id}}" class="btn btn-default"><i class="fa fa-btn fa-plus"></i>Crear Evaluación</a>
            </div>
        </div>
    </div>    
@endsection