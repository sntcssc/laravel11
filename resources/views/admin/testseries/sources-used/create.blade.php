@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Source Used</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('sources-used.store') }}">
        @csrf

        <!-- Student Selection -->
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select Student</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}" data-unique-id="{{ $student->unique_id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->first_name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Unique ID -->
        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control @error('unique_id') is-invalid @enderror" value="{{ old('unique_id') }}" required readonly placeholder="Unique ID will auto-populate">
            @error('unique_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
                <select name="subject" class="form-control @error('subject') is-invalid @enderror" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $key => $subject)
                        <option value="{{ $key }}" {{ old('subjects_materials.0.subject') == $key ? 'selected' : '' }}>
                            {{ $subject }}
                        </option>
                    @endforeach
                </select>
            @error('subject') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <div class="form-group">
            <label for="source_material">Source Material</label>
            <textarea name="source_material" class="form-control @error('source_material') is-invalid @enderror" 
                      rows="4" placeholder="Enter the source material details" required>{{ old('source_material') }}</textarea>
            @error('source_material') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
</div>


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the student dropdown and unique_id input
        const studentDropdown = document.getElementById('student_id');
        const uniqueIdField = document.getElementById('unique_id');

        // Function to update unique_id field when a student is selected
        studentDropdown.addEventListener('change', function() {
            // Find the selected option and retrieve its data-unique-id attribute
            const selectedOption = studentDropdown.options[studentDropdown.selectedIndex];
            const uniqueId = selectedOption.getAttribute('data-unique-id');
            
            if (uniqueId) {
                uniqueIdField.value = uniqueId; // Set the unique_id field to the student's unique_id
            } else {
                uniqueIdField.value = ''; // Clear the unique_id field if no student is selected
            }
        });

        // Trigger change event on page load to populate unique_id if there is an old value
        if (studentDropdown.value) {
            const selectedOption = studentDropdown.options[studentDropdown.selectedIndex];
            uniqueIdField.value = selectedOption.getAttribute('data-unique-id');
        }
    });
</script>
@endsection
@endsection
