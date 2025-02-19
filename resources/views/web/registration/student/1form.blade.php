@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Step {{ $step }} of 8</h2>
    <progress value="{{ ($step / 8) * 100 }}" max="100"></progress>
    <form action="{{ route('student.form.store', $step) }}" method="POST">
        @csrf
        @include("student.forms.step$step")
        <button type="submit" class="btn btn-success">Next</button>
    </form>
</div>
@endsection
