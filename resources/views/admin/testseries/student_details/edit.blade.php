@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Student Detail - {{ $studentDetail->unique_id }}</h1>

    <form action="{{ route('student_details.update', $studentDetail) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" data-unique-id="{{ $student->unique_id }}" {{ old('student_id', $studentDetail->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control @error('unique_id') is-invalid @enderror" value="{{ old('unique_id', $studentDetail->unique_id) }}" required readonly>
            @error('unique_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="self_study_hours">How many hours do you currently spend on self-study?</label>
            <input type="number" id="self_study_hours" name="self_study_hours" class="form-control" value="{{ old('self_study_hours', $studentDetail->self_study_hours) }}" required>
            @error('self_study_hours')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="has_separate_study_room">Do you have a separate study room at home?</label>
            <select id="has_separate_study_room" name="has_separate_study_room" class="form-control" required>
                <option value="1" {{ old('has_separate_study_room', $studentDetail->has_separate_study_room) == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('has_separate_study_room', $studentDetail->has_separate_study_room) == '0' ? 'selected' : '' }}>No</option>
            </select>
            @error('has_separate_study_room')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="is_in_hostel" class="form-label">Is in Hostel</label>
            <select name="is_in_hostel" class="form-select @error('is_in_hostel') is-invalid @enderror" required>
                <option value="1" {{ old('is_in_hostel', $studentDetail->is_in_hostel) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_in_hostel', $studentDetail->is_in_hostel) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('is_in_hostel')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="is_residing_in_kolkata" class="form-label">Is Residing in Kolkata</label>
            <select name="is_residing_in_kolkata" class="form-select @error('is_residing_in_kolkata') is-invalid @enderror" required>
                <option value="1" {{ old('is_residing_in_kolkata', $studentDetail->is_residing_in_kolkata) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_residing_in_kolkata', $studentDetail->is_residing_in_kolkata) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('is_residing_in_kolkata')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="travel_time" class="form-label">Travel Time</label>
            <input type="text" name="travel_time" class="form-control @error('travel_time') is-invalid @enderror" value="{{ old('travel_time', $studentDetail->travel_time) }}" required>
            @error('travel_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prelims_mode" class="form-label">Prelims Mode</label>
            <input type="text" name="prelims_mode" class="form-control @error('prelims_mode') is-invalid @enderror" value="{{ old('prelims_mode', $studentDetail->prelims_mode) }}" required>
            @error('prelims_mode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prelims_mode_reason" class="form-label">Prelims Mode Reason</label>
            <textarea name="prelims_mode_reason" class="form-control @error('prelims_mode_reason') is-invalid @enderror" required>{{ old('prelims_mode_reason', $studentDetail->prelims_mode_reason) }}</textarea>
            @error('prelims_mode_reason')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mentoring_mode" class="form-label">Mentoring Mode</label>
            <input type="text" name="mentoring_mode" class="form-control @error('mentoring_mode') is-invalid @enderror" value="{{ old('mentoring_mode', $studentDetail->mentoring_mode) }}" required>
            @error('mentoring_mode')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mentoring_mode_reason" class="form-label">Mentoring Mode Reason</label>
            <textarea name="mentoring_mode_reason" class="form-control @error('mentoring_mode_reason') is-invalid @enderror" required>{{ old('mentoring_mode_reason', $studentDetail->mentoring_mode_reason) }}</textarea>
            @error('mentoring_mode_reason')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="is_full_time_preparation" class="form-label">Full Time Preparation</label>
            <select name="is_full_time_preparation" class="form-select @error('is_full_time_preparation') is-invalid @enderror" required>
                <option value="1" {{ old('is_full_time_preparation', $studentDetail->is_full_time_preparation) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_full_time_preparation', $studentDetail->is_full_time_preparation) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('is_full_time_preparation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="work_schedule" class="form-label">Work Schedule</label>
            <input type="text" name="work_schedule" class="form-control @error('work_schedule') is-invalid @enderror" value="{{ old('work_schedule', $studentDetail->work_schedule) }}" required>
            @error('work_schedule')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="daily_preparation_hours" class="form-label">Daily Preparation Hours</label>
            <input type="number" name="daily_preparation_hours" class="form-control @error('daily_preparation_hours') is-invalid @enderror" value="{{ old('daily_preparation_hours', $studentDetail->daily_preparation_hours) }}" required>
            @error('daily_preparation_hours')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('student_details.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const studentDropdown = document.querySelector('select[name="student_id"]');
        const uniqueIdField = document.getElementById('unique_id');

        studentDropdown.addEventListener('change', function() {
            const selectedOption = studentDropdown.options[studentDropdown.selectedIndex];
            const uniqueId = selectedOption.getAttribute('data-unique-id');

            uniqueIdField.value = uniqueId || '';
        });

        if (studentDropdown.value) {
            const selectedOption = studentDropdown.options[studentDropdown.selectedIndex];
            uniqueIdField.value = selectedOption.getAttribute('data-unique-id');
        }
    });
</script>
@endsection

@endsection
