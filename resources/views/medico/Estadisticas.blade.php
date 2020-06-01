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
        <h4><b>Consideraciones Generales</b></h4>
       <table class="table table-striped table-bordered" >
           <tr>
               <td>Número de pacientes</td>
               <td>{{$numeroPacientes}}</td>
           </tr>
           <tr>
               <td>Media de edad</td>
               <td>{{round($mediaEdad,2)." años"}}</td>
           </tr>
           <tr>
               <td>Media de edad en origen de enfermedad</td>
               <td>{{round($mediaEdadInitPD,2)." años"}}</td>
           </tr>
           <tr>
               <td>Número de evaluaciones registradas en el sistema</td>
               <td>{{$numeroEvaluaciones}}</td>
           </tr>

       </table>
    </div>

    @foreach ($graficas as $chart)
        <div tyle="position: relative; maintainAspectRatio:true, height:40vh; width:80vw">

            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </div>
        @endforeach

        </div>
@endsection