@extends('admin.layouts.app')

@section('content')
    <h1>Batch Details: {{ $batch->name }}</h1>

    <p><strong>Name:</strong> {{ $batch->name }}</p>
    <p><strong>Start Date:</strong> {{ $batch->start_date ? $batch->start_date->format('d-m-Y') : 'N/A' }}</p>
    <p><strong>End Date:</strong> {{ $batch->end_date->format('d-m-Y') }}</p>
    <p><strong>Status:</strong> {{ $batch->status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('batches.index') }}">Back to Batches</a>
@endsection
