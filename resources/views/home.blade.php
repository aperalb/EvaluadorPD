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
    <div class="container">
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Mi Perfil</h4>

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>{{ Auth::user()->name }} {{ Auth::user()->apellido1 }} {{ Auth::user()->apellido2 }}</th>
                                </tr>
                                <tr>
                                    <td rowspan="1">
                                        @php
                                            $url="default";
                                            if(isset(explode('.',Auth::user()->getFirstMediaUrl('fotografias'),2 )[1])){
                                                $url='https://cloud-cube-eu.'.explode('.',Auth::user()->getFirstMediaUrl('fotografias'),2 )[1];
                                            }
                                        @endphp
                                        <img src="{{$url}}"
                                             width="300" height="300",
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" align="center"/>

                                    </td>

                                </tr>
                                <tr>
                                    <td rowspan="1">
                                        <strong>Consulta: </strong> {{ Auth::user()->medico->consulta}}

                                    </td>

                                </tr>
                                <tr>
                                    <td rowspan="1">
                                        <strong> Especialidad: </strong> {{ Auth::user()->medico->especialidad}}

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['medico.edit',Auth::user()->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            </table>

                            <div style="text-align: center">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td rowspan="1">
                                            <a href="{{route('medico.Estadisticas')}}" class="btn"><strong>Estadísticas</strong>
                                                <img src="/images/estadisticas.png"
                                                     width="210" height="130"
                                                     alt="Estadisticas"
                                                />
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>


                        </div>
                        <div style="width: 10%; float: right;">
                            <br><br>
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">
                                        <a href="{{route('paciente.index')}}" class="btn"><strong>Mis pacientes</strong>
                                            <img src="/images/pacientes.png"
                                                 width="150" height="150"
                                                 alt="Pacientes"

                                            />
                                        </a>
                                    </td>
                                </tr>
                                <tr ><td></td></tr>
                                <tr>
                                    <td rowspan="1">
                                        <a href="{{route('evaluacion.misEvaluaciones')}}" class="btn"><strong>Mis evaluaciones</strong>
                                            <img src="/images/evaluaciones.png"
                                                 width="150" height="150"
                                                 alt="Evaluaciones"

                                            />
                                        </a>

                                    </td>
                                </tr>
                                <td></td>
                                <tr>
                                    <td rowspan="1">
                                        {{--{{route('medicamento.index')}}--}}
                                        <a href="{{route('medicamento.index')}}" class="btn"><strong>Medicamentos</strong>
                                            <img src="/images/medicamentos.png"
                                                 width="150" height="150"
                                                 alt="Medicamentos"

                                            />
                                        </a>

                                    </td>
                                </tr>
                                <td></td>
                                <tr>
                                    <td rowspan="1">
                                        <a href="{{route('formulario.index')}}" class="btn"><strong>Formularios</strong>
                                            <img src="/images/formulario.png"
                                                 width="150" height="150"
                                                 alt="Formularios"

                                            />
                                        </a>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection