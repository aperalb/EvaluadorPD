@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($responsable, [ 'route' => ['responsable.update',$responsable->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Editar Responsable</h4>

                            <table class="table table-striped table-bordered">


                                <tr>
                                    <div class="form-group">
                                        <th>Nombre</th>
                                        <td>{!! Form::text('nombre',$responsable->nombre,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <th>Apellido 1</th>
                                    <td>{!! Form::text('apellido1',$responsable->apellido1,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Apellido 2</th>
                                    <td> {!! Form::text('apellido2',$responsable -> apellido2,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Numero de teléfono</th>
                                    <td>{!! Form::text('numerotel',$responsable->numerotel,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Dirección</th>
                                    <td>{!! Form::text('direccion',$responsable->direccion,['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<th>Email</th>--}}
                                    {{--<td>{!! Form::text('email',$responsable->email,['class'=>'form-control', 'autofocus']) !!}</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <th>Relación</th>
                                    <td>{!! Form::text('parentesco',$responsable->getParentesco($pacienteID, $responsable->id),['class'=>'form-control', 'required', 'autofocus']) !!}</td>
                                </tr>

                            </table>

                        </div>

                        <div class="floatRight">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">

                                        <img src="{{$responsable->fotografia}}"
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
                                        {!! Form::url('fotografia',$responsable -> fotografia,['class'=>'form-control', 'autofocus','maxlength="1000"']) !!}
                                    </td>

                                </tr>
                                {!! Form::hidden('pacienteID', $pacienteID) !!}</td>

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