
@extends('admin.layouts.app')

@section('content')
    <h1>Enrollment History for {{ $student->name }}</h1>
    
    @if($enrollments->isEmpty())
        <p>No enrollments found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Program Name</th>
                    <th>Batch</th>
                    <th>Section</th>
                    <th>Enrollment Status</th>
                    <th>Enrolled At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->program->name }}</td>
                        <td>{{ $enrollment->batch ? $enrollment->batch->name : 'N/A' }}</td>
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
    @endif
    <a href="{{ route('students.index') }}">Back to Students List</a>
@endsection