@extends('layouts.app')


@section('content')
    <h1>My Patients</h1>

    @foreach ($patients as $patient)
        <div>
            <li>
                <a href="/mypatients/{{ $patient->id }}"> {{ $patient->name }}</a>
            </li>

        </div>
    @endforeach
    <hr>
    <h3>Add New Patient</h3>
    </hr>


    <form method = "POST" action="/mypatients">
        {{ csrf_field() }}
        <div class="form-group">
            <textarea name="name" class="form-control"></textarea>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Patient</button>
        </div>

    </form>
    </div>

@stop