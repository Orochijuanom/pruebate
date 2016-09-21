@extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión</div>
            <div class="panel-body">     
                @if (Session::get('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                        <br><br>            
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/docente/crear_evaluacion') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="intentos" class="col-md-4 control-label">Intentos</label>
                        <div class="col-md-6">
                            <input id="intentos" type="text" class="form-control" name="intentos" required autofocus>                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_presentacion" class="col-md-4 control-label">Fecha presentación</label>

                        <div class="col-md-6">
                            <input id="fecha_presentacion" type="date" class="form-control" name="fecha_presentacion"  required>                            
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Crear Evaluación
                            </button>
                        </div>
                    </div>
                </form> 
             </div>
        </div>
    </div>    
@endsection
