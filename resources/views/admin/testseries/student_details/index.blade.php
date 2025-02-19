<!-- resources/views/student_details/index.blade.php -->

@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Student Details</h1>
    <a href="{{ route('student_details.create') }}" class="btn btn-primary mb-3">Add New Detail</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Unique ID</th>
                <th>Full-Time Preparation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentDetails as $detail)
                <tr>
                    <td>{{ $detail->student->first_name }}</td>
                    <td>{{ $detail->unique_id }}</td>
                    <td>{{ $detail->is_full_time_preparation ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('student_details.edit', $detail) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- <form action="{{ route('student_details.destroy', $detail) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form> -->
                        <!-- Delete Anchor Trigger Modal -->
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#warningAlertModal{{ $detail->id }}">
                            Delete
                        </a>

                        <!-- Warning Alert Modal -->
                        <x-warning-alert 
                            :id="$detail->id" 
                            :message="'Are you sure you want to delete ' . $detail->name . '?'"
                            :route="route('student_details.destroy', $detail->id)" 
                        />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
