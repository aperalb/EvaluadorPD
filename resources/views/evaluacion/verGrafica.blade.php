@extends('layouts.app')

@section('content')
    <h1>Resumen de la Evaluación</h1>

    <div tyle="position: relative; maintainAspectRatio:true, height:40vh; width:80vw">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
@endsection