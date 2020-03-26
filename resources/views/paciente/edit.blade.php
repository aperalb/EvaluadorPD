@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Paciente</div>

                    <div class="panel-body">

                        {!! Form::model($paciente, [ 'route' => ['paciente.update',$paciente->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}

                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del paciente') !!}
                            {!! Form::text('nombre',$paciente->nombre,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('apellido1', 'Apellido1 del paciente') !!}
                            {!! Form::text('apellido1',$paciente->apellido1,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>

                        {!! Form::submit('Actualizar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
