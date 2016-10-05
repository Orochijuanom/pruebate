@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li class="active">Asignaciones</li>
</ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de asignación academica </div>
            <div class="panel-body">
                <div class="panel-body">
                    
                    @if (Session::get('message_delete'))
                        <div class="alert alert-success">
                            {{Session::get('message_delete')}}
                            <br><br>            
                        </div>
                    @endif

                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    @if (count($asignaciones) > 0)

                     <div class="alert alert-success" role="alert">
                        La asignación academica
                        <a href="/reportes/asignacion"><span class="pull-right clickable"><i class="fa fa-download"></i></span></a>
                    </div>

                        <table class="table table-bordered">

                            <!-- Table Headings -->
                            <thead>
                                <th>Grado</th>
                                <th>Materia</th>
                                <th>Docente</th>                                
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($asignaciones as $asignacione)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><a href="/administrador/asignaciones/{{$asignacione->id}}">{{ $asignacione->grado->descripcion }}</a></div>
                                        </td>

                                        <td class="table-text">
                                            <div>{{ $asignacione->materia->descripcion }}</div>
                                        </td>

                                        <td class="table-text">
                                            <div>{{ $asignacione->user->name }}</div>
                                        </td>                                        
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                        {!! $asignaciones->links() !!}
                        <br/>
                    @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuentran asignciones en el la plataforma.</p>

                    @endif

                    <a href="/administrador/asignaciones/create" class="btn btn-default"><i class="fa fa-btn fa-plus"></i>Realizar asignación</a>

                       

                    
                </div>
            </div>
                
@endsection