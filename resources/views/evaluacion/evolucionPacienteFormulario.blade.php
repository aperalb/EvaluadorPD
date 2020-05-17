@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-100 col-md-offset-2">
            <h1 style="text-align: center">Evolución del paciente en el tiempo.</h1>
            <h5 style="text-align: center">Evolución del resultado de los formularios resueltos en las sucesivas evaluaciones realizadas al paciente.</h5>

            <hr>
            <table class="table table-striped">
                <tr>
                    <th style="text-align: center">Paciente:</th>
                    <td style="text-align: center">{{$paciente->user->getFullsurnameAttribute()}}</td>
                </tr>
                <tr style="background-color: rgba(0, 0, 0, .05)">
                    <th style="text-align: center">Fecha de inicio de la enfermedad:</th>
                    <td style="text-align: center">{{$paciente->fechainiciopd}}</td>
                </tr>
            </table>
            <hr>
            @foreach ($charts as $chart)
            <div tyle="position: relative; maintainAspectRatio:true, height:40vh; width:80vw">

                {!! $chart->container() !!}
                {!! $chart->script() !!}
            </div>
                @endforeach

        </div>
        <a href={{ url()->previous() }} class="btn btn-info">Volver</a>

    </div>

    </div>
@endsection