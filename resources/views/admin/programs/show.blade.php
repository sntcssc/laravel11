@extends('admin.layouts.app')

@section('content')
    <h1>Program Details: {{ $program->name }}</h1>

    <p><strong>Name:</strong> {{ $program->name }}</p>
    <p><strong>Description:</strong> {{ $program->description }}</p>
    <p><strong>Status:</strong> {{ $program->status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('programs.index') }}">Back to Programs</a>
@endsection
