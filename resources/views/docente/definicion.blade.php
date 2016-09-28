@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/estudiante/">Inicio</a></li>
    <li class="active">Evaluación</li>
</ol>

    <div class="panel panel-default">
        <div class="panel-heading">Titulo</div>
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

                
                    <form class="form-horizontal" role="form" method="POST" action="/docente/definicion">
                    {{ csrf_field() }}
                    

                    
                        <div class="panel panel-default">
                            <div class="panel-heading">Pregunta</div>
                            <div class="panel-body">
                                <p><textarea id="descripcion" class="form-control ckeditor" name="descripcion" required autofocus></textarea></p>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group">                            
                                <div class="col-md-12">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        A ) <input type="radio" name="respuesta" value="A" required>
                                    </span>
                                    <textarea id="opa" class="form-control" name="opa" required></textarea>                            
                                    </div><!-- /input-group -->                               
                                </div>
                        </div>

                        <div class="form-group">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                    B ) <input type="radio" name="respuesta" value="B">
                                </span>
                                <textarea id="opb" class="form-control" name="opb" required></textarea>                           
                                </div><!-- /input-group -->                       
                            </div>
                        </div>

                        <div class="form-group">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                   C ) <input type="radio" name="respuesta" value="C">
                                </span>
                                <textarea id="opc" class="form-control" name="opc" required></textarea>                            
                                </div><!-- /input-group -->
                            </div>
                        </div>

                        <div class="form-group">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                <span class="input-group-addon">
                                   D ) <input type="radio" name="respuesta" value="D">
                                </span>
                                <textarea id="opd" class="form-control" name="opd" required></textarea>                            
                                </div><!-- /input-group -->                            
                            </div>
                        </div>
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
                                    <td>{!! $pregunta->descripcion !!}</td>
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
        </form> 

        
    </div>        
@endsection