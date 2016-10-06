@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li><a href="/administrador/grados">Grados</a></li>
    <li class="active">{{$grado->descripcion}}</li>
</ol>
    <div class="panel panel-default">
        <div class="panel-heading">Crear grados</div>
            <div class="panel-body">
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="/administrador/grados/{{$grado->id}}/estudiantes" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">Archivo</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus>

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cargar Estudiantes
                                </button>
                            </div>
                        </div>
                    </form>

            
            
                
            </div>
        </div>
    </div>    
@endsection