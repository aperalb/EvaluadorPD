@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-100 col-md-offset-2">
            <h1 style="text-align: center">Resumen de la Evaluación</h1>
            {{--@if($evaluacion->fechafin == null)--}}
                {{--<h3 style="text-align: center">--}}
                    {{--<img src="/images/noFinalizada.png"--}}
                         {{--alt="avatar"--}}
                         {{--width="50" height="50" ,--}}
                         {{--onerror="this.onerror=null; this.src='/images/Default.jpg'"--}}
                         {{--alt="Finalizada"/>--}}
                    {{--En Curso--}}

                {{--</h3>--}}
            {{--@else--}}
                {{--<h3>--}}
                    {{--<img src="/images/finalizada.png"--}}
                         {{--alt="avatar"--}}
                         {{--width="50" height="50" ,--}}
                         {{--onerror="this.onerror=null; this.src='/images/Default.jpg'"--}}
                         {{--alt="Finalizada"/>--}}
                    {{--{{'Finalizada: '.date('yy-m-d', strtotime($evaluacion->fechafin)) }}--}}
                {{--</h3>--}}
            {{--@endif--}}
            {{--<hr>--}}
            {{--<table class="table table-striped">--}}
                {{--<tr>--}}
                    {{--<th>Paciente:</th>--}}
                    {{--<td>{{$evaluacion->paciente->user->getFullsurnameAttribute()}}</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<th> Fecha de inicio:</th>--}}
                    {{--<td>{{date('yy-m-d', strtotime($evaluacion->created_at))}}</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
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