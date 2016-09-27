
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

                    @if (count($asignaciones) > 0)
                        @foreach($asignaciones as $asignacione)
                            <ul>
                                <li>{{$asignacione->materia->descripcion}}
                                    <ul>
                                        @if(count($asignacione->evaluaciones) > 0)
                                            @foreach($asignacione->evaluaciones as $evaluacione)
                                                <li><a href="/estudiante/evaluacion/{{$evaluacione->id}}">
                                                        <i class="fa fa-check-square-o"></i>                                                        
                                                        {{$evaluacione->descripcion}}
                                                        @if($evaluacione->limite < date('Y-m-d h:i:s'))
                                                            - Caducada {{$evaluacione->limite}}
                                                        @else
                                                            - Vigente    
                                                        @endif
                                                    </a>
                                            @endforeach
                                        @endif
                                    </ul>
                            </ul>
                        @endforeach

                     
                    @endif
                       

                    
                </div>
            </div>
                
@endsection