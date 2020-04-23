@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::model($user, [ 'route' => ['medico.update',$user->id], 'files' => 'true','method'=>'PUT', 'class'=>'form-inline', 'enctype'=>'multipart/form-data']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Editar Medico</h4>

                            <table class="table table-striped table-bordered">


                                <tr>
                                    <div class="form-group">
                                        <th>Nombre</th>
                                        <td>{!! Form::text('name',$user->name,['class'=>'form-control', 'required', 'autofocus', 'size = 50']) !!}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <th>Apellido 1</th>
                                    <td>{!! Form::text('apellido1',$user->apellido1,['class'=>'form-control', 'required', 'autofocus', 'size = 50']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Apellido 2</th>
                                    <td> {!! Form::text('apellido2',$user -> apellido2,['class'=>'form-control', 'required', 'autofocus', 'size = 50']) !!}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{!! Form::email('email',$user->email,['class'=>'form-control', 'required', 'autofocus', 'size = 50']) !!}</td>
                                </tr>

                                <tr>
                                    <th>Número Telefono</th>
                                    <td>{!! Form::text('numerotel',$user->medico->numerotel,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Consulta</th>
                                    <td>{!! Form::text('consulta',$user->medico->consulta,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>
                                <tr>
                                    <th>Especialidad</th>
                                    <td>{!! Form::text('especialidad',$user->medico->especialidad,['class'=>'form-control', 'autofocus']) !!}</td>
                                </tr>

                            </table>

                        </div>

                        <div class="floatRight">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">

                                        <img src="{{Auth::user()->getFirstMediaUrl('fotografias')}}"
                                             width="300" height="300"
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />

                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                       Imagen
                                    </th>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::file('fotografia',['id'=>'fotografia','name'=>'fotografia','class'=>'form-control', 'autofocus','size=40%']) !!}
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