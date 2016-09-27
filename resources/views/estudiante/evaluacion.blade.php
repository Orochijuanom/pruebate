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
                @if (Session::get('message'))
                        <div class="alert alert-success">
                            {{Session::get('message')}}
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

                @if(count($preguntas)>0)
                    <form class="form-horizontal" role="form" method="POST" action="/estudiante/evaluacion/{{$evaluacione->id}}/respuestas">
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
                                    <input type="radio" name="{{$pregunta->id}}" value="A" required>
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
                                    <input type="radio" name="{{$pregunta->id}}" value="B">
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
                                    <input type="radio" name="{{$pregunta->id}}" value="C">
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
                                    <input type="radio" name="{{$pregunta->id}}" value="D">
                                </span>
                                <label id="opd" class="form-control" name="opd" >{{$pregunta->opd}}</label>                            
                                </div><!-- /input-group -->                            
                            </div>
                        </div> 
                                                           
                        
                    @endforeach

                    {!! $preguntas->links() !!}

                    <div class="form-group">
                    
                    <input type="hidden" name="pagina" value="{{$preguntas->currentPage()}}" />
                    @if($preguntas->currentPage() != $preguntas->lastPage() )
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" name="estado" value="0">
                            Guardar y continuar
                        </button>
                    </div>
                    
                    @else
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" name="estado" value="1">
                            Guardar y finalizar
                        </button>
                    </div>
                    
                    @endif
                     
                        
                    </div>
                    </form>
                @endif


                 
            </div>            
        </div>
        
    </div>        
@endsection