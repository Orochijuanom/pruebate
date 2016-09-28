@extends('layouts.docente')
@section('content')
<ol class="breadcrumb">
    <li><a href="/administrador/">Inicio</a></li>
    <li><a href="/administrador/docentes">Docentes</a></li>
    <li class="active">Crear Docentes</li>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role_id">

                                    @foreach ($roles as $role)
                                        @if (old('role_id') == $role->id)
                                        
                                            <option value="{{$role -> id}}" selected>{{$role->descripcion}}</option>
                                        @else

                                            <option value="{{$role -> id}}">{{$role->descripcion}}</option>

                                        @endif
                                    @endforeach

                                </select>


                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
        </div>
    </div>    
@endsection