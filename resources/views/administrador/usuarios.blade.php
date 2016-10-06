@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li class="active">Docentes</li>
</ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de Administrador </div>
            <div class="panel-body">
                <div class="panel-body">                                                 
                    @if (count($usuarios) > 0)
                     <div class="alert alert-success" role="alert">
                        Los usuarios creados
                        <a href="/reportes/usuarios"><span class="pull-right clickable"><i class="fa fa-download"></i></span></a>
                     </div>
                    <table class="table table-bordered">

                        <!-- Table Headings -->
                        <thead>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Perfil</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><a href="/administrador/docentes/{{$usuario->id}}">{{ $usuario->name }}</a></div>
                                        </td>                                        
                                        <td class="table-text">
                                            <div>{{ $usuario->email}}</div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $usuario->role->descripcion}}</div>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $usuarios->links() !!}
                    @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran docentes en el la plataforma.</p>

                    @endif

                    
                       

                    
                </div>
            </div>
                
@endsection