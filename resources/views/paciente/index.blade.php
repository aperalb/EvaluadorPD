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
        <a href={{url('/paciente/create')}} class="btn btn-primary"><big><strong>Registrar Nuevo</strong></big></a>
        @endif

        <br><br>
        <br>
        @foreach ($pacientes as $paciente)
            <div id ="paciente" style="display: inline-block; padding: 10px;">

                <table id="indexPacientes" style="border: 0px; border-collapse: collapse;" cellpadding="5" cellspacing="5" border="0">

                    <tr>
                        <td rowspan="1">
                            @php
                            $url="default";
                            if(isset(explode('.',$paciente->user->getFirstMediaUrl('fotografias'),2 )[1])){
                                $url='https://cloud-cube-eu.'.explode('.',$paciente->user->getFirstMediaUrl('fotografias'),2 )[1];
                            }
                            @endphp
                            <img src="{{$url}}"
                                 alt="avatar" style="border-radius: 50%;"
                                 width="200" height="200",
                                 onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                 alt="Fotografia" />

                        </td>

                    </tr>
                    <tr >
                        <th>{{ $paciente->user->getFullsurnameAttribute() }}</th>
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
