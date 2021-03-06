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
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Responsables</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Parentesco</th>
                                <th>Nombre</th>
                                <th align ="center" colspan ="3">Acciones</th>
                            </tr>
                            @foreach($responsables as $responsable)
                                @php $responsableID = $responsable->id @endphp
                                <tr>
                                    <td>{{ $responsable->getParentesco($paciente->id,$responsableID)}}</td>
                                    <td>{{ $responsable->user->getFullsurnameAttribute() }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['responsable.show2','idResponsable'=>$responsable->id,'idPaciente'=> $paciente->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Perfil', ['class'=> 'btn btn-info','style'=>"width: 100%"])!!}
                                        {!! Form::close() !!}                                    </td>
                                    @if(Auth::User()->showRol()=='MEDICO')

                                    <td>
                                        <a href={{url('/responsable/delete/?responsableID='.$responsable->id.'&&pacienteID='.$paciente->id )}} style="width: 100%" class="btn btn-danger"  onclick="return confirm('¿Seguro que deseas eliminar este Responsable?')">Eliminar</a>
                                    </td>
                                    <td>
                                        <a href={{url('/responsable/editar/?responsableID='.$responsable->id."&&pacienteID=".$paciente->id)}} style="width: 100%" class="btn btn-info">Editar</a>
                                    </td>
                                        @endif
                                </tr>
                            @endforeach
                        </table>
                        @if(Auth::User()->showRol()=='MEDICO')
                        <td>
                            <a href={{url('/responsable/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Crear Responsable</a>
                        </td>
                        @endif
                        <td>
                            <a href={{ url('/paciente/'.$paciente->id) }} class="btn btn-info">Volver</a>
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection