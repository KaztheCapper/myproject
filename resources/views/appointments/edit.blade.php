@extends('layouts.app')

@section('content')

    <h1>Edit Result</h1>
    <form method = "POST" action="/appointments/{{ $appointment->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
            <textarea name="result" class="form-control">{{ $appointment->Result }}</textarea>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Result</button>
        </div>

    </form>
@stop