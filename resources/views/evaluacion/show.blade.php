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
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">
                            @if(Auth::User()->showRol()=='MEDICO')
                                @if($evaluacion->fechafin == "")
                                    {!! Form::model($evaluacion, [ 'route' => ['evaluacion.update',$evaluacion->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                                @endif
                            @endif
                            <h4>Detalles de la Evaluación</h4>
                            <table class="table table-striped table-bordered" >


                                <tr id="estadoActual">
                                    <th>Fecha Inicio</th>
                                    <td>{{date('Y-m-d', strtotime($evaluacion->created_at))}}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    @if($evaluacion->fechafin == "")
                                        <td>En curso</td>
                                    @else
                                        <td>{{'Finalizada ' .date('Y-m-d', strtotime($evaluacion->fechafin))}}</td>
                                    @endif
                                </tr>
                                <tr id="nuevoEstado" style="display: none;background-color: rgba(0,0,0,.05)">
                                    <th>Finalizar Evaluación</th>
                                    <td>No podrá volver a editarla. {!! Form::checkbox('nuevoEstado',null,false,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>

                                <tr id="pesoActual">
                                    <th>Peso actual del paciente</th>
                                    <td>{{ $evaluacion->peso . ' kg' }}</td>

                                </tr>
                                <tr id="nuevoPeso" style="display: none;background-color: rgba(0,0,0,.05)">
                                    <th>Nuevo Peso</th>
                                    <td>{!! Form::number('peso',$evaluacion->peso,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}</td>

                                </tr>
                                <tr id="alturaActual" style="background-color: transparent">
                                    <th>Altura actual del paciente</th>

                                    <td>{{ $evaluacion->altura . ' m' }}</td>
                                </tr>


                                <tr id="nuevaAltura" style="display: none;">
                                    <th>Nueva Altura</th>
                                    <td>{!! Form::number('altura',$evaluacion->altura,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}</td>

                                </tr>

                            </table>
                            <br>
                            <div>
                                <h4>Observaciones</h4>
                                <a>

                                    <pre>{!! Form::textarea('descripcion',$evaluacion->descripcion,['id'=>'observaciones','cols'=>'80','rows'=>'10','readonly', 'autofocus']) !!}</pre>
                                </a>

                            </div>
                            @if(Auth::User()->showRol()=='MEDICO')
                                @if($evaluacion->fechafin == "")

                                    <div style="align-content: center; margin-left: 7%">
                                        <a> <input class="btn btn-info" type="button" id="Editar" value="Editar" onclick="edit()"></a>

                                        {!! Form::submit('Guardar',['id'=>'guardar','style'=>'display:none','class'=>'btn-success btn']) !!}
                                        {!! Form::close() !!}

                                        {!! Form::open(['route' => ['evaluacion.destroy',$evaluacion->id], 'method' => 'delete']) !!}
                                        <br>
                                        {!! Form::submit('Eliminar', ['id'=>'eliminar','style'=>'display:none','class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar esta evaluación?");'])!!}
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            @endif

                        </div>

                        <div class="floatRight" style="margin-top: 3%">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td rowspan="1"  style="text-align: center; font-size: 16px">

                                        <a><b>{{$evaluacion->paciente->user->name}} <br> {{$evaluacion->paciente->user->apellido1.' '.$evaluacion->paciente->user->apellido2}}</b></a>

                                    </td>
                                <tr>
                                    <td rowspan="1">
                                        <img src="{{$evaluacion->paciente->user->getFirstMediaUrl('fotografias') }}"
                                             width="300" height="300",
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />
                                    </td>
                                </tr>

                            </table>
                        </div>

                        </table>
                    </div>

                    @if(Auth::User()->showRol()=='MEDICO')
                        @if($evaluacion->fechafin == "")
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td colspan="10">Formularios Pendientes</td>
                                </tr>

                                @foreach($formulariosNorealizados as $formulario)
                                    <tr>
                                        <td>
                                            {!! Form::open(['route' => ['formulario.create','idFormulario'=>$formulario->id,'idEvaluacion'=> $evaluacion->id], 'method' => 'get']) !!}
                                            {!! Form::submit($formulario->nombre, ['class'=> 'btn btn-link','style'=>"width: 100%; text-align:left"])!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach
                            </table>
                        @endif
                    @endif
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td colspan="10">Formularios Realizados</td>
                            <td colspan="2" align="center">Puntuación Obtenida</td>
                            @if($evaluacion->fechafin == "")
                                <td align="center">Acciones</td>
                            @endif

                        </tr>
                        @foreach($formulariosRealizados as $formulario)
                            <tr>
                                <td colspan="10">
                                    {!! Form::open(['route' => ['formulario.show','idFormulario'=>$formulario->id,'idEvaluacion'=> $evaluacion->id], 'method' => 'get']) !!}
                                    {!! Form::submit($formulario->nombre, ['class'=> 'btn btn-link','style'=>"width: 100%; text-align:left"])!!}
                                    {!! Form::close() !!}
                                </td>
                                <td colspan="2" align="center">{{$formulario->puntuacionObtenida($evaluacion->id, $formulario->id)." / ".$formulario->max}}</td>
                                @if($evaluacion->fechafin == "")

                                    <td align="center">
                                        {!! Form::open(['route' => ['evaluacion.destroyResolucion',$formulario->id, $evaluacion->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['style'=>"margin-top: 1%",'class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar esta pregunta?");'])!!}
                                        {!! Form::close() !!}

                                    </td>
                                @endif
                            </tr>

                        @endforeach
                    </table>

                    <td>
                        <a href={{ url('/evaluacion/index/'.$evaluacion->paciente_id) }} class="btn btn-info">Volver</a>
                    </td>
                </div>


            </div>
        </div>

    </div>

    </div>



    <script type="application/javascript">
        function edit() {
            var Editar=document.getElementById('Editar');
            var observaciones = document.getElementById("observaciones");
            var pesoActual=document.getElementById("pesoActual");
            var alturaActual=document.getElementById("alturaActual");
            var estadoActual=document.getElementById("estadoActual");
            var nuevoPeso = document.getElementById("nuevoPeso");
            var nuevaAltura = document.getElementById("nuevaAltura");
            var guardar=document.getElementById("guardar");
            var eliminar=document.getElementById("eliminar");
            var nuevoEstado=document.getElementById("nuevoEstado");
            observaciones.removeAttribute('readonly');
            alturaActual.style.display="none";
            pesoActual.style.display="none";
            Editar.style.display="none";
            estadoActual.style.display="none";
            nuevoPeso.style.display="";
            nuevaAltura.style.display="";
            nuevoEstado.style.display="";
            guardar.style.display="";
            eliminar.style.display="";



        }




    </script>
@endsection