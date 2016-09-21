@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Realizar asignación academica</div>
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/administrador/asignaciones') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('grado_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Grado</label>

                            <div class="col-md-6">
                                <select class="form-control" name="grado_id">

                                    @foreach ($grados as $grado)
                                        @if (old('grado_id') == $grado->id)
                                        
                                            <option value="{{$grado -> id}}" selected>{{$grado->descripcion}}</option>
                                        @else

                                            <option value="{{$grado -> id}}">{{$grado->descripcion}}</option>

                                        @endif
                                    @endforeach

                                </select>


                                @if ($errors->has('grado_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grado_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('materia_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Materia</label>

                            <div class="col-md-6">
                                <select class="form-control" name="materia_id">

                                    @foreach ($materias as $materia)
                                        @if (old('materia_id') == $materia->id)
                                        
                                            <option value="{{$materia -> id}}" selected>{{$materia->descripcion}}</option>
                                        @else

                                            <option value="{{$materia -> id}}">{{$materia->descripcion}}</option>

                                        @endif
                                    @endforeach

                                </select>


                                @if ($errors->has('materia_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('materia_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Docente</label>

                            <div class="col-md-6">
                                <select class="form-control" name="user_id">

                                    @foreach ($users as $user)
                                        @if (old('user_id') == $user->id)
                                        
                                            <option value="{{$user -> id}}" selected>{{$user->name}}</option>
                                        @else

                                            <option value="{{$user -> id}}">{{$user->name}}</option>

                                        @endif
                                    @endforeach

                                </select>


                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
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