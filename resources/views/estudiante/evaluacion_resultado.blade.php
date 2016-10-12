@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/estudiante/">Inicio</a></li>
    <li class="active">Evaluación</li>
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

                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#myModal">Material de apoyo disponible</button>
                    
                </div>
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          
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
                    

                    @foreach($preguntas as $index => $pregunta)
                        <div class="panel panel-default">
                            <div class="panel-heading">Pregunta -  {{ $index + 1 }}</div>
                            <div class="panel-body">
                                <p>{!! $pregunta->descripcion !!}</p>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group
                                @if($presentacione != null) 

                                    @foreach($presentacione->preguntas as $respuesta)
                                        @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'A' && $respuesta->pivot->respuesta == $pregunta->respuesta )
                                            has-success
                                        @elseif($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'A' && $respuesta->pivot->respuesta != $pregunta->respuesta)
                                            
                                            has-error
                                        @endif
                                    @endforeach
                                @endif">                            
                                <div class="col-md-12">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        A ) <input type="radio" name="{{$pregunta->id}}" value="A" required disabled
                                        @if($presentacione != null) 
                                            @foreach($presentacione->preguntas as $respuesta)
                                                @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'A' )
                                                    checked
                                                @endif
                                            @endforeach
                                        @endif>
                                    </span>
                                    <label id="opa" class="form-control" name="opa" >{{$pregunta->opa}}</label>                            
                                    </div><!-- /input-group -->                               
                                </div>
                        </div>

                        <div class="form-group
                                @if($presentacione != null) 
                                    @foreach($presentacione->preguntas as $respuesta)
                                        @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'B' && $respuesta->pivot->respuesta == $pregunta->respuesta )
                                            has-success
                                        @elseif($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'B' && $respuesta->pivot->respuesta != $pregunta->respuesta)
                                            
                                            has-error
                                        @endif
                                    @endforeach
                                @endif">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    B ) <input type="radio" name="{{$pregunta->id}}" value="B" disabled
                                    @if($presentacione != null) 
                                            @foreach($presentacione->preguntas as $respuesta)
                                                @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'B' )
                                                    checked
                                                @endif
                                            @endforeach
                                    @endif>
                                </span>
                                <label id="opb" class="form-control" name="opb" >{{$pregunta->opb}}</label>                           
                                </div><!-- /input-group -->                       
                            </div>
                        </div>

                        <div class="form-group
                                @if($presentacione != null) 
                                    @foreach($presentacione->preguntas as $respuesta)
                                        @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'C' && $respuesta->pivot->respuesta == $pregunta->respuesta )
                                            has-success
                                        @elseif($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'C' && $respuesta->pivot->respuesta != $pregunta->respuesta)
                                            
                                            has-error
                                        @endif
                                    @endforeach
                                @endif">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                   C ) <input type="radio" name="{{$pregunta->id}}" value="C" disabled
                                   @if($presentacione != null) 
                                            @foreach($presentacione->preguntas as $respuesta)
                                                @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'C' )
                                                    checked
                                                @endif
                                            @endforeach
                                    @endif>
                                </span>
                                <label id="opc" class="form-control" name="opc">{{$pregunta->opc}}</label>                            
                                </div><!-- /input-group -->
                            </div>
                        </div>

                        <div class="form-group
                                @if($presentacione != null) 
                                    @foreach($presentacione->preguntas as $respuesta)
                                        @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'D' && $respuesta->pivot->respuesta == $pregunta->respuesta )
                                            has-success
                                        @elseif($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'D' && $respuesta->pivot->respuesta != $pregunta->respuesta)
                                            
                                            has-error
                                        @endif
                                    @endforeach
                                @endif">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                   D ) <input type="radio" name="{{$pregunta->id}}" value="D" disabled
                                   @if($presentacione != null) 
                                            @foreach($presentacione->preguntas as $respuesta)
                                                @if($respuesta->pivot->pregunta_id == $pregunta->id && $respuesta->pivot->respuesta == 'D' )
                                                    checked
                                                @endif
                                            @endforeach
                                    @endif>
                                </span>
                                <label id="opd" class="form-control" name="opd" >{{$pregunta->opd}}</label>                            
                                </div><!-- /input-group -->                            
                            </div>
                        </div>
                    </div>                                                       
                 </div>                      
                                                           
                        
                    @endforeach

                    {!! $preguntas->links() !!}

                    <div class="form-group">
                    
                    <input type="hidden" name="pagina" value="{{$preguntas->currentPage()}}" />
                    @if($limite != 1 )
                        @if($intentos < $evaluacione->intentos)
                            <a href="/estudiante/evaluacion/{{$evaluacione->id}}/nuevo" class="btn btn-default"><i class="fa fa-btn fa-plus"></i>Realizar nuevo intento</a>
                        @endif
                    
                    @else
                    
                    
                    @endif                                             
                    </div>
                    </form>
                @endif
            </div>            
        </div>

        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Material de apoyo disponible</h4>
        </div>
        <div class="modal-body">
          <iframe width="560" height="315" src="{{$evaluacione->apoyo}}" frameborder="0" allowfullscreen></iframe>
          <ul>
            <li><a href="{{$evaluacione->apoyo}}" target="_blank">Material de apoyo disponible</a>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
        
    </div>        
@endsection