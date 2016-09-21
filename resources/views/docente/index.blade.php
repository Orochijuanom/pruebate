@extends('layouts.docente')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Panel de gestión docnete</div>
  <div class="panel-body">
    @if(count($grados)>0)
        <div class="alert alert-success" role="alert">Los cursos asignados</div>
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
        <div class="alert alert-warning" role="alert">No se encontraron asignaciones para usted</div>
    @endif        
  </div>
</div>
@endsection