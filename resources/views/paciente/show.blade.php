@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Datos personales del paciente</h4>
                            <table class="table table-striped table-bordered">


                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $paciente->user->getFullsurnameAttribute() }}</td>
                                </tr>
                                <tr>
                                    <th>Sexo</th>
                                    <td>{{ $paciente->sexo }}</td>
                                </tr>
                                <tr>
                                    <th>NUHSA</th>
                                    <td>{{ $paciente->nuhsa }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de nacimiento</th>
                                    <td>{{ $paciente->fechanac }}</td>
                                </tr>
                                <tr>
                                    <th>Contacto</th>
                                    <td>{{ $paciente->numerotel }}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{{ $paciente->direccion }}</td>
                                </tr>
                                <tr>
                                    <th>Año de inicio PD</th>
                                    <td>{{ $paciente->getAgeInitPD() }}</td>
                                </tr>

                            </table>
                            <div>

                                <table style="border: 0px; border-collapse: collapse;" cellpadding="5" cellspacing="5" border="0" >
                                    <tr>
                                        <td>
                                            <a href={{url('/tratamiento/index/'.$paciente->id)}} class="btn btn-primary">Tratamientos
                                            <img src="/images/formulario.png"
                                                 width="50" height="50"
                                                 alt="Tratamientos"

                                            />
                                            </a>
                                        </td>
                                        <td>
                                            <a href={{url('/sintoma/index/'.$paciente->id)}} class="btn btn-primary">Síntomas
                                            <img src="/images/sintomas.png"
                                                 width="50" height="50"
                                                 alt="Sintomas"
                                            />
                                            </a>
                                        </td>
                                        <td>
                                            <a style="width:100%" href={{url('/evaluacion/index/'.$paciente->id)}} class="btn btn-primary">Evaluaciones
                                            <img src="/images/evaluaciones.png"
                                                 width="50" height="50"
                                                 alt="Evaluaciones"
                                            />
                                            </a>
                                        </td>
                                        <td>
                                            <a  href={{url('/responsable/index/'.$paciente->id)}} class="btn btn-primary">Responsables
                                            <img src="/images/responsables.png"
                                                 width="50" height="50"
                                                 alt="Responsables"
                                            />
                                            </a>
                                        </td>

                                    <tr>

                                </table>
                            </div>
                            <br>
                            <div>
                                <h4>Observaciones</h4>
                                <a>  <pre><textarea readonly cols="80" rows="10">{{$paciente->observaciones}}</textarea></pre></a>
                            </div>

                        </div>

                        <div class="floatRight" style="margin-top:3%">
                            <table style="border: 0px; border-collapse: collapse;" cellpadding="5" cellspacing="5" border="0" >

                                <tr>
                                    <td rowspan="1">
                                        @php
                                            $url="default";
                                            if(isset(explode('.',$paciente->user->getFirstMediaUrl('fotografias'),2 )[1])){
                                                $url='https://cloud-cube-eu.'.explode('.',$paciente->user->getFirstMediaUrl('fotografias'),2 )[1];
                                            }
                                        @endphp
                                        <img src="{{$url}}"
                                             width="300" height="300",
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />

                                    </td>

                                </tr>
                                @if(Auth::user()->showRol()=='MEDICO')
                                    <tr>
                                        <td>
                                            {!! Form::open(['route' => ['paciente.edit',$paciente->id], 'method' => 'get']) !!}
                                            {!! Form::submit('Editar', ['class'=> 'btn btn-info','style'=>'width:100%'])!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <a style="width: 100%" href={{url('/paciente/delete/'.$paciente->id)}} class="btn btn-danger" onclick = "return confirm('¿Seguro que deseas eliminar este paciente?');" >Eliminar</a> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a  style="width: 100%" href={{url('/evaluacionChart/evolucionPacienteFormulario/'.$paciente->id)}} class="btn btn-primary">Evolución del Paciente
                                            <br>
                                            <img src="/images/evolucionPaciente.jpg"
                                                 width="100%" height="200"
                                                 alt="Evolución Paciente"
                                            />
                                        </td>
                                    </tr>
                                @endif
                            </table>

                        </div>



                        <table class="table table-striped table-bordered">
                            <tr>
                                <td style="display:none" colspan="10">Datos cuantitativos</td>
                            </tr>
                        </table>
                        @if(Auth::user()->showRol()=='MEDICO')
                            <td>
                                <a href={{ url('/paciente') }} class="btn btn-secondary">Volver</a>
                            </td>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection