@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li class="active">Logs</li>
</ol>
<div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de docentes </div>
            <div class="panel-body">
    
    @if (count($logs) > 0)
        <div class="alert alert-success" role="alert">
            Los grados creados
            <a href="/reportes/logs"><span class="pull-right clickable"><i class="fa fa-download"></i></span></a>
        </div>

        <table class="table table-bordered">

            <!-- Table Headings -->
            <thead>
                <th>Usuario</th>
                <th>Table</th>
                <th>Operación</th>
                <th>Detalle</th>                                
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{$log->user->name}}                                                
                        <td>{{$log->tabla}}</td>
                        <td>{{$log->operacion}}</td>
                        <td>{{$log->descripcion}}</td>                                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $logs->links() !!}
     @else
        <p class='alert alert-info'><strong>Whoops!</strong> No se encontraron logs en el la plataforma.</p>   
    @endif
    </div>
@endsection