
 @extends('layouts.docente')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Panel de gestión de docentes </div>
            <div class="panel-body">
                <div class="panel-body">
                    
                    @if (Session::get('message_delete'))
                        <div class="alert alert-success">
                            {{Session::get('message_delete')}}
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

                    @if (count($docentes) > 0)

                     <div class="alert alert-success" role="alert">Los docentes creados</div>

                        <table class="table table-bordered">

                            <!-- Table Headings -->
                            <thead>
                                <th>Nombre</th>
                                <th>Email</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($docentes as $docente)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div><a href="/administrador/docentes/{{$docente->id}}">{{ $docente->name }}</a></div>
                                        </td>
                                        
                                        <td class="table-text">
                                            <div>{{ $docente->email}}</div>
                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $docentes->links() !!}
                    @else

                        <p class='alert alert-info'><strong>Whoops!</strong> No se encuetran docentes en el la plataforma.</p>

                    @endif

                    <a href="/register" class="btn btn-default"><i class="fa fa-btn fa-plus"></i>Crear Docente</a>

                       

                    
                </div>
            </div>
                
@endsection