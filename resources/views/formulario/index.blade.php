@extends('layouts.app')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('danger') !!}</li>
        </ul>
    </div>
@endif
@section('content')
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <h4>Formularios disponibles en el sistema</h4>
                        <hr>
                        <div class="panel-body" style="text-align:center">
                            <table class="table table-striped table-bordered"  >
                                <tr >
                                    <th>Nombre</th>
                                    <th>Nº preguntas</th>
                                    <th>Puntuación Máxima</th>
                                    <th >Acciones</th>


                                </tr>
                                @foreach($formularios as $formulario)
                                    <tr>
                                        <td>
                                            <a href={{url('/formulario/showList/'.$formulario->id)}} class="btn btn-link">{{$formulario->nombre }}</a>
                                        </td>
                                        <td>{{$formulario->numeroPreguntas($formulario->id) }}</td>
                                        <td>{{ $formulario->max}}</td>
                                        <td>
                                            {!! Form::open(['route' => ['formulario.destroy',$formulario->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger'])!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                            <td>
                                <a href='#' class="btn btn-primary " onclick='muestraFormulario()'>Nuevo Formulario</a>
                            </td>
                            <td>
                                <a href={{ url('/home') }} class="btn btn-secondary">Volver</a>
                            </td>




                        {!! Form::open(['route' =>['formulario.altaFormulario', 'method'=>'POST','class'=>'form-inline']]) !!}

                        <br>
                        <div id="nuevoFormulario" style="visibility: hidden">
                            <table class="table table-striped table-bordered" >
                                <tr>
                                    <th>
                                        <label for="nombre">Título del nuevo Formulario</label>
                                    </th>

                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="nombre" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;" name="nombre" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="descripcion">Introduzca la descripción</label>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                 <pre>
                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="8" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;" required></textarea>
                                    </pre>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                                        {!! Form::close() !!}

                                        <a href='#' class="btn-primary btn" style="margin-left: 5%" onclick='ocultaFormulario()'>Cancelar</a>
                                    </td>


                                </tr>

                            </table>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        function muestraFormulario() {

            var x = document.getElementById('nuevoFormulario');
            x.setAttribute('style',"");
        }

        function ocultaFormulario() {

            var x = document.getElementById('nuevoFormulario');
            x.setAttribute('style',"visibility:hidden");
        }

    </script>
@endsection