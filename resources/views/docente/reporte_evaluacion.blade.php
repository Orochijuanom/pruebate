@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/docente/">Inicio</a></li>
    <li><a href="/docente/index_evaluacion">Asignaciones</a></li>
    <li class="active">Reporte</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">Reporte evaluación</div>
    <div class="panel-body">        
        @foreach($datos as $dato)
            <table class="table">
                <thead>
                    <th colspan="3">{{$dato['competencia']}}</th>
                </thead>                
                <tbody>
                <tr>
                    <th>Pregunta</th>
                    <th>Correctas</th>
                    <th>Erroneas</th>
                </tr>          
                @foreach($dato['preguntas'] as $pregunta)
                    <tr>
                        <td>{!! $pregunta['pregunta']  !!}</td>
                        <td>{{ $pregunta['respestas']['correctas']  }}</td>
                        <td>{{$pregunta['respestas']['errores']}}</td>
                    </tr>    
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endforeach

        
    </div>
</div>

@endsection