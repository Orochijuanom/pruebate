@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li class="active">Grados</li>
</ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de grados </div>
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

                    @if (count($grados) > 0)

                     <div class="alert alert-success" role="alert">
                        Los grados creados
                        <a href="/reportes/grados"><span class="pull-right clickable"><i class="fa fa-download"></i></span></a>
                    </div>

                        <table class="table table-bordered">

                            <!-- Table Headings -->
                            <thead>
                                <th>Descripcion</th>                                
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($grados as $grado)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><a href="/administrador/grados/{{$grado->id}}">{{ $grado->descripcion }}</a></div>
                                        </td>                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran grados en el la plataforma.</p>

                    @endif

                    <a href="/administrador/grados/create" class="btn btn-default"><i class="fa fa-btn fa-plus"></i>Crear grado</a>

                       

                    
                </div>
            </div>
                
@endsection