
@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de estudiantes </div>
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

                    @if (count($materias) > 0)
                        @foreach($materias as $materia)
                            <ul>
                                <li>{{$materia->materia->descripcion}}
                                    <ul>
                                        @if(count($materia->evaluaciones) > 0)
                                            @foreach($materia->evaluaciones as $evaluacione)
                                                <li>{{$evaluacione->descripcion}}
                                            @endforeach
                                        @endif
                                    </ul>
                            </ul>
                        @endforeach

                     
                    @endif
                       

                    
                </div>
            </div>
                
@endsection