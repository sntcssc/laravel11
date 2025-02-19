@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Enrollment</h2>

        <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Similar to the create form -->
            <div class="form-group">
                <label for="student_id">Student</label>
                <select name="student_id" id="student_id" class="form-control">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $enrollment->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Repeat for program_id, batch_id, section_id, and status similar to the create view -->

            <button type="submit" class="btn btn-success">Update Enrollment</button>
        </form>
    </div>
@endsection
