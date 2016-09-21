@extends('layouts.docente')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/docente/">Inicio</a></li>
      <li><a href="/docente/evaluacion/">Evaluaciones</a></li>
      <li class="active">Definición</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">
            <!-- Creando las preguntas-->
                @if (Session::get('flash_message'))
                    <div class="alert alert-success">
                        {{Session::get('flash_message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/docente/definicion') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-6">
                            <textarea id="descripcion" class="form-control" name="descripcion" required autofocus></textarea>                            
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
                              <textarea id="opa" class="form-control" name="opa" required></textarea>                            
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
                              <textarea id="opb" class="form-control" name="opb" required></textarea>                            
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
                              <textarea id="opc" class="form-control" name="opc" required></textarea>                            
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
                              <textarea id="descripcion" class="form-control" name="opd" required></textarea>                            
                            </div><!-- /input-group -->                            
                        </div>
                    </div> 
                    <input type="hidden" name="evaluacione_id" value="{{$id}}" />                                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Crear Pregunta
                            </button>
                        </div>
                    </div>
                </form> 

                <!-- Listando las preguntas -->
                @if(count($preguntas)>0)
                    <div class="alert alert-success" role="alert">Preguntas</div>
                    <table class="table table-bordered">  
                        <thead>
                            <th>N.</th>
                            <th>Descripción</th>
                            <th>Op A</th>
                            <th>Op B</th>
                            <th>Op C</th>
                            <th>Op D</th>
                        </thead>  
                        <tbody>
                            @foreach($preguntas as $pregunta)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$pregunta->descripcion}}</td>
                                    <td>{{$pregunta->opa}}</td>
                                    <td>{{$pregunta->opb}}</td>
                                    <td>{{$pregunta->opc}}</td>
                                    <td>{{$pregunta->opd}}</td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning" role="alert">No se encontraron preguntas para esta evaluación</div>
                @endif

                 
            </div>            
        </div>
        
    </div>        
@endsection