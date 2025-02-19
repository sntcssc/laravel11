@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Enrollment List</h2>

        <a href="{{ route('enrollments.create') }}" class="btn btn-primary mb-3">Create New Enrollment</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Program</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->student->first_name ?? '' }} {{ $enrollment->student->last_name ?? '' }}</td>
                        <td>{{ $enrollment->program->name }}</td>
                        <td>{{ $enrollment->batch->name }}</td>
                        <td>{{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</td>
                        <td>{{ $enrollment->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
