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


        <h2>Mis pacientes</h2>


        <br>
        @if(Auth::User()->showRol()=='MEDICO')
        <a href={{url('/paciente/create')}} class="btn btn-info"><big><strong>Registrar Nuevo</strong></big></a>
        @endif

        <br><br>
        <br>
        @foreach ($pacientes as $paciente)
            <div id ="paciente" style="display: inline-block; padding: 10px;">

                <table class="table table-striped table-bordered" id="indexPacientes">
                    <tr>
                        <th>{{ $paciente->user->getFullsurnameAttribute() }}</th>
                    </tr>
                    <tr>
                        <td rowspan="1">

                            <img src="{{$paciente->fotografia}}"
                                 width="150" height="150"
                                 onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                 alt="Fotografia" />

                        </td>

                    </tr>

                    <tr>
                        <td style="text-align: center">
                            {!! Form::open(['route' => ['paciente.show',$paciente->id], 'method' => 'get']) !!}
                            {!! Form::submit('Perfil', ['class'=> 'btn btn-info','style'=>"width: 100%"])!!}
                            {!! Form::close() !!}
                        </td>
                    </tr>


                </table>



            </div>
            @endforeach
            </table>



    </div>

@endsection
