
@extends('admin.layouts.app')

@section('content')
    <h1>Current Enrollments for {{ $student->name }}</h1>
    
    @if($currentEnrollments->isEmpty())
        <p>No active enrollments found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Program Name</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Enrollment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currentEnrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->program->name }}</td>
                        <td>{{ $enrollment->batch ? $enrollment->batch->name : 'N/A' }}</td>
                        <td>{{ $enrollment->section ? $enrollment->section->name : 'N/A' }}</td>
                        <td>{{ ucfirst($enrollment->status) }}</td>
                        <td>
                            <form action="{{ route('students.withdraw', ['student' => $student->id, 'enrollment' => $enrollment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Withdraw</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('students.index') }}">Back to Students List</a>
@endsection