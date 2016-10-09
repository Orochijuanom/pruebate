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
        @foreach($competencias as $competencia)
        a
            {{$competencia->id}}
        @endforeach
    </div>
</div>

@endsection