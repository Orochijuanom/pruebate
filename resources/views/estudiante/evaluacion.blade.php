@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/evaluacion/">Evaluaciones</a></li>
      <li class="active">Definición</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">{{$evaluacione->descripcion}} Grado: {{$evaluacione->asignacione->grado->descripcion}} Materia: {{$evaluacione->asignacione->materia->descripcion}}</div>
            <div class="panel-body">
            <!-- Creando las preguntas-->
                @if (Session::get('flash_message'))
                    <div class="alert alert-success">
                        {{Session::get('flash_message')}}
                        <br><br>            
                    </div>
                @endif

                @if(count($preguntas)>0)
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/docente/definicion') }}">
                    {{ csrf_field() }}
                    
                    @foreach($preguntas as $pregunta)
                        
                        <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Pregunta</label>
                        <div class="col-md-6">
                            {!! $pregunta->descripcion !!}                       
                        </div>
                        </div>
                        <hr/>                    
                        <div class="form-group">
                            <label for="opa" class="col-md-4 control-label">Opción A</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="respuesta" value="A">
                                </span>
                                <label id="opa" class="form-control" name="opa" >{{$pregunta->opa}}</label>                            
                                </div><!-- /input-group -->                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="opb" class="col-md-4 control-label">Opción B</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="respuesta" value="B">
                                </span>
                                <label id="opb" class="form-control" name="opb" >{{$pregunta->opb}}</label>                           
                                </div><!-- /input-group -->                       
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="opc" class="col-md-4 control-label">Opción C</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="respuesta" value="C">
                                </span>
                                <label id="opc" class="form-control" name="opc">{{$pregunta->opc}}</label>                            
                                </div><!-- /input-group -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-md-4 control-label">Opción D</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" name="respuesta" value="D">
                                </span>
                                <label id="opd" class="form-control" name="opd" >{{$pregunta->opd}}</label>                            
                                </div><!-- /input-group -->                            
                            </div>
                        </div> 
                        <input type="hidden" name="evaluacione_id" value="$id" />                                    
                        
                    @endforeach
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Guardar y continuar
                            </button>
                        </div>
                    </div>
                    </form>
                @endif


                 
            </div>            
        </div>
        
    </div>        
@endsection