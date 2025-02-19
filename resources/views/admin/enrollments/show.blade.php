@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Enrollment Details</h2>

        <!-- Program Enrollment Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Enrollment Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Student:</strong> {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</li>
                    <li class="list-group-item"><strong>Program:</strong> {{ $enrollment->program->name }}</li>
                    <li class="list-group-item"><strong>Batch:</strong> {{ $enrollment->batch->name }} ({{ $enrollment->batch->start_date->format('Y') }})</li>
                    <li class="list-group-item"><strong>Section:</strong> {{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $enrollment->status ? 'Active' : 'Inactive' }}</li>
                    <li class="list-group-item"><strong>Enrolled At:</strong> {{ $enrollment->created_at->format('d M Y') }}</li>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <a href="{{ route('students.show', $enrollment->student->id) }}" class="btn btn-primary">Back to Student</a>
    </div>
@endsection
