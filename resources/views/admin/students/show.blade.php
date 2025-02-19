@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Student Details</h2>

        <!-- Student Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Student Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Unique ID:</strong> {{ $student->unique_id }}</li>
                    <li class="list-group-item"><strong>Full Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</li>
                    <li class="list-group-item"><strong>Father's Name:</strong> {{ $student->father_name }}</li>
                    <li class="list-group-item"><strong>Father's Occupation:</strong> {{ $student->father_occupation }}</li>
                    <li class="list-group-item"><strong>Date of Birth:</strong> {{ $student->dob->format('d M Y') }}</li>
                    <li class="list-group-item"><strong>Gender:</strong> {{ $student->gender }}</li>
                    <li class="list-group-item"><strong>Category:</strong> {{ $student->category }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $student->email }}</li>
                    <li class="list-group-item"><strong>Mobile Number:</strong> {{ $student->mobile_number }}</li>
                    <li class="list-group-item"><strong>WhatsApp Number:</strong> {{ $student->whatsapp_number }}</li>
                    <li class="list-group-item"><strong>Admission Date:</strong> {{ $student->admission_date }}</li>
                    <li class="list-group-item"><strong>Present Address:</strong> {{ $student->present_address }}, {{ $student->present_state }} - {{ $student->present_pin }}</li>
                    <li class="list-group-item"><strong>Permanent Address:</strong> {{ $student->permanent_address }}, {{ $student->permanent_state }} - {{ $student->permanent_pin }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $student->status }}</li>
                    <li class="list-group-item"><strong>Login Status:</strong> {{ $student->login ? 'Active' : 'Inactive' }}</li>
                </ul>
            </div>
        </div>

        <!-- Program Enrollments -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Program Enrollments</h5>
            </div>
            <div class="card-body">
                @if($student->programEnrollments->isEmpty())
                    <p>No program enrollments for this student.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Program</th>
                                <th>Batch</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->programEnrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->program->name }}</td>
                                    <td>{{ $enrollment->batch->name }} ({{ $enrollment->batch->start_date->format('Y') }})</td>
                                    <td>{{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</td>
                                    <td>{{ $enrollment->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('enrollments.show', $enrollment->id) }}" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Buttons for Actions -->
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
        </form>
    </div>
@endsection
