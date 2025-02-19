@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Student List</h2>

        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add New Student</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unique ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Program</th>
                    <th>Batch</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->unique_id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->mobile_number }}</td>
                        <td>
                            @foreach($student->programEnrollments as $enrollment)
                                {{ $enrollment->program->name }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($student->programEnrollments as $enrollment)
                                {{ $enrollment->batch->name }}<br>
                            @endforeach
                        </td>
                        <td>
                            @if($student->status == 'active')
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $students->links() }}
    </div>
@endsection
