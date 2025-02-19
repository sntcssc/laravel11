@extends('admin.layouts.app')

@section('content')
    <h1>Enrollment Details</h1>
    <p><strong>Student:</strong> {{ $student->name }}</p>
    <p><strong>Program:</strong> {{ $enrollment->program->name }}</p>
    <p><strong>Batch:</strong> {{ $enrollment->batch->name }}</p>
    <p><strong>Section:</strong> {{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($enrollment->status) }}</p>
    <p><strong>Enrolled At:</strong> {{ $enrollment->enrolled_at->format('d-m-Y') }}</p>
    
    <a href="{{ route('students.show', $student->id) }}">Back to Student</a>
@endsection
