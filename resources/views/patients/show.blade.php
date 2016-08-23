

@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>


    <script>

        var bloodResults = Array()

        var bloodResultsDate = Array()
    </script>



    @include('flash::message')


    <h1>{{$patient->name}}</h1>
    <ul class="list-group">
        @foreach($patient->appointments as $appointment)
            <li class="list-group-item">
                {{$appointment->Result}}
               <a href="#" style="float:right">{{$appointment->Date}}</a>

            </li>
            <script>
                bloodResults.push({{$appointment->Result}})
                bloodResultsDate.push("{{$appointment->Date}}")
            </script>
        @endforeach
    </ul>
    <hr>
         <h3>Submit Appointment Result</h3>
    </hr>


     <form method = "POST" action="/mypatients/{{$patient->id}}/appointments">
         {{ csrf_field() }}
         <div class="form-group">
            <textarea name="result" class="form-control" placeholder="Blood Result">{{old ('result')}}</textarea>
             <textarea name="Date" class="form-control" placeholder="Date(dd/mm/yy)">{{old ('Date')}}</textarea>


        </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit Result</button>
            </div>

    </form>



   @if(count($errors))

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif


   <div class="ct-chart ct-perfect-fourth" style="height:300px;">

    <script>

       var graphData = {

            labels: bloodResultsDate,

            series: [
                bloodResults
            ]
        }
        new Chartist.Line('.ct-chart', {
            labels: bloodResultsDate,
            series: [
                bloodResults
            ]
        }, {
            low: 0,
            showArea: true


        });

    </script>
    </div>






</div>

@stop