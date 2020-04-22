@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'paciente.store', 'class'=>'form-inline']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Añadir Paciente</h4>

                            <table class="table table-striped table-bordered">


                                <tr>
                                    <div class="form-group">
                                        <th>Nombre</th>
                                        <td>{!! Form::text('nombre',null,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <th>Apellido 1</th>
                                    <td>{!! Form::text('apellido1',null,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Apellido 2</th>
                                    <td> {!! Form::text('apellido2',null,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>


                                <tr>
                                    <th>Sexo</th>
                                    <td>
                                        {!! Form::select('sexo', array('Hombre' => 'Hombre', 'Mujer' => 'Mujer'),['class'=>'form-control', 'required', 'autofocus']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>NUHSA</th>
                                    <td>{!! Form::text('nuhsa',null,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de nacimiento</th>
                                    <td>{!! Form::date('fechanac',null,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Número Telefono</th>
                                    <td>{!! Form::text('numerotel',null,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{!! Form::text('direccion',null,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de inicio PD</th>
                                    <td>{!! Form::date('fechainiciopd',null,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>

                            </table>

                            <div>
                                <h4>Observaciones</h4>
                                <a>  <pre>{!! Form::textarea('observaciones',null,['class'=>'form-control', 'autofocus',' cols="80" rows="10"']) !!}</pre></a>
                            </div>

                        </div>

                        <div class="floatRight">

                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">

                                        <img src="/images/Default.jpg"
                                             width="300" height="300"
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" id="fotografia"/>
                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        URL Fotografía
                                    </th>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::url('fotografia',null,['class'=>'form-control', 'autofocus','maxlength' => '1000']) !!}
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>


                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection