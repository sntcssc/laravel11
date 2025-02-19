@extends('admin.layouts.app')

@section('content')
    <h1>Student Details: {{ $student->name }}</h1>
    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->dob->format('d-m-Y') }}</p>
    
    <h2>Enrollment History</h2>
    <table>
        <thead>
            <tr>
                <th>Program</th>
                <th>Batch</th>
                <th>Section</th>
                <th>Status</th>
                <th>Enrolled At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->program->name }}</td>
                    <td>{{ $enrollment->batch->name }}</td>
                    <td>{{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</td>
                    <td>{{ ucfirst($enrollment->status) }}</td>
                    <td>{{ $enrollment->enrolled_at->format('d-m-Y') }}</td>
                    <td>
                        @if($enrollment->status == 'active')
                            <form action="{{ route('students.withdraw', ['student' => $student->id, 'enrollment' => $enrollment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Withdraw</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <a href="{{ route('students.index') }}">Back to Students</a>
@endsection
