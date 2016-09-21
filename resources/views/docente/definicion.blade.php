@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">
                @if(count($preguntas)>0)
                    <div class="alert alert-success" role="alert">Preguntas</div>
                    <table class="table table-bordered">  
                        <thead>
                            <th>N.</th>
                            <th>Grado</th>
                            <th>Materia</th>
                            <th>Opciones</th>
                        </thead>  
                        <tbody>
                            @foreach($grados as $grado)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$grado->grado->grados}}</td>
                                    <td>{{$grado->materia->descripcion}}</td>
                                    <td><a href="/docente/evaluacion/{{$grado->id}}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron preguntas para esta evaluación</div>
                @endif

                 
            </div>
        </div>
    </div>        
@endsection