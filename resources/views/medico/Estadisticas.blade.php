@extends('layouts.app')

@section('content')
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container">
       {{$numeroPacientes}}
    </div>

    @foreach ($graficas as $chart)
        <div tyle="position: relative; maintainAspectRatio:true, height:40vh; width:80vw">

            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </div>
        @endforeach

        </div>
@endsection