@extends('admin.layouts.app')

@section('content')
    <h1>Section Details: {{ $section->name }}</h1>

    <p><strong>Name:</strong> {{ $section->name }}</p>
    <p><strong>Batch:</strong> {{ $section->batch->name }}</p>
    <p><strong>Seats:</strong> {{ $section->seat }}</p>
    <p><strong>Status:</strong> {{ $section->status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('sections.index') }}">Back to Sections</a>
@endsection
