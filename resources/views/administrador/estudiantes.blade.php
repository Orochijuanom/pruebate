@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li class="active">Estudiantes</li>
</ol>
    <div class="panel panel-default">
        <div class="panel-heading">Estudiantes</div>
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/administrador/estudiantes') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">Excel</label>

                            <div class="col-md-6">
                                <input id="archivo" type="file" class="form-control" name="archivo" value="{{ old('archivo') }}" required autofocus>

                                @if ($errors->has('archivo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('archivo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>

            
            
                
            </div>
        </div>
    </div>    
@endsection