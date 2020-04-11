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
                                    <td>{{ $paciente->getFullsurnameAttribute() }}</td>
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
                                    <th>Año de inicio PD</th>
                                    <td>{{ $paciente->getAgeInitPD() }}</td>
                                </tr>

                            </table>
                            <div>
                                <a href={{url('/tratamiento/index/'.$paciente->id)}} class="btn btn-info">Tratamientos</a>
                                <a href={{url('/sintoma/index/'.$paciente->id)}} class="btn btn-info">Síntomas</a>
                                <a href={{url('/evaluacion/index/'.$paciente->id)}} class="btn btn-info">Evaluaciones</a>
                                <a href={{url('/responsable/index/'.$paciente->id)}} class="btn btn-info">Responsables</a>
                            </div>
                            <br>
                            <div>
                                <h4>Observaciones</h4>
                                <a>  <pre><textarea readonly cols="80" rows="10">{{$paciente->observaciones}}</textarea></pre></a>
                            </div>

                        </div>

                        <div class="floatRight">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">

                                        <img src="{{$paciente->fotografia}}"
                                             width="300" height="300"
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['paciente.edit',$paciente->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td> <a href={{url('/paciente/delete/'.$paciente->id)}} class="btn btn-danger" onclick = "return confirm('¿Seguro que deseas eliminar este paciente?');" >Eliminar</a> </td>
                                </tr>


                            </table>
                        </div>



                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="10">Datos cuantitativos</td>
                            </tr>
                        </table>

                        <td>
                            <a href={{ url('/paciente') }} class="btn btn-info">Volver</a>
                        </td>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection