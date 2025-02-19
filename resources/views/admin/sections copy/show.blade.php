@extends('admin.layouts.app')

@section('content')
    <h1>Section Details: {{ $section->name }}</h1>
    <p><strong>Section Name:</strong> {{ $section->name }}</p>
    <p><strong>Program:</strong> {{ $section->program->name }}</p>
    
    <a href="{{ route('sections.index') }}">Back to Sections</a>
@endsection
