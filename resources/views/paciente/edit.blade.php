@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($paciente, [ 'route' => ['paciente.update',$paciente->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Editar Paciente</h4>

                            <table class="table table-striped table-bordered">


                                <tr>
                                    <div class="form-group">
                                        <th>Nombre</th>
                                        <td>{!! Form::text('nombre',$paciente->user->name,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <th>Apellido 1</th>
                                    <td>{!! Form::text('apellido1',$paciente->user->apellido1,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Apellido 2</th>
                                    <td> {!! Form::text('apellido2',$paciente->user -> apellido2,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>

                                <tr>
                                    <th>Sexo</th>
                                    <td>
                                        @php
                                            $arraySexo=[];
                                                if($paciente->sexo == 'Hombre'){
                                                    $arraySexo = ['Hombre' => 'Hombre','Mujer' => 'Mujer'];

                                                }else{
                                                    $arraySexo = ['Mujer' => 'Mujer','Hombre' => 'Hombre'];

                                                }
                                        @endphp
                                        {!! Form::select('sexo', $arraySexo,['class'=>'form-control', 'required', 'autofocus']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>NUHSA</th>
                                    <td>{!! Form::text('nuhsa',$paciente->nuhsa,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de nacimiento</th>
                                    <td>{!! Form::date('fechanac',$paciente->fechanac,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Número Telefono</th>
                                    <td>{!! Form::text('numerotel',$paciente->numerotel,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{!! Form::text('direccion',null,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de inicio PD</th>
                                    <td>{!! Form::date('fechainiciopd',$paciente->fechainiciopd,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>

                            </table>

                            <div>
                                <h4>Observaciones</h4>
                                <a>  <pre>{!! Form::textarea('observaciones',$paciente->observaciones,['class'=>'form-control', 'autofocus',' cols="80" rows="10"']) !!}</pre></a>
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
                                    <th>
                                        URL Fotografía
                                    </th>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::url('fotografia',$paciente -> fotografia,['class'=>'form-control', 'autofocus','maxlength="1000"']) !!}
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