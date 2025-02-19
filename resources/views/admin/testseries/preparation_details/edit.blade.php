@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Preparation Detail</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('preparation_details.update', $preparationDetail) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                @foreach($students as $student)
                <option value="{{ $student->id }}" data-unique-id="{{ $student->unique_id }}" {{ old('student_id', $preparationDetail->student_id) == $student->id ? 'selected' : '' }}>{{ $student->first_name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control @error('unique_id') is-invalid @enderror" value="{{ old('unique_id', $preparationDetail->unique_id) }}" required readonly>
            @error('unique_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Highest Education Qualification -->
        <div class="mb-3">
            <label for="highest_education_qualification" class="form-label">Highest Education Qualification</label>
            <input type="text" name="highest_education_qualification" id="highest_education_qualification" class="form-control @error('highest_education_qualification') is-invalid @enderror" value="{{ old('highest_education_qualification', $preparationDetail->highest_education_qualification) }}" required placeholder="Enter your highest education qualification">
            @error('highest_education_qualification')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Graduation Subject -->
        <div class="mb-3">
            <label for="graduation_subject" class="form-label">Graduation Subject</label>
            <input type="text" name="graduation_subject" id="graduation_subject" class="form-control @error('graduation_subject') is-invalid @enderror" value="{{ old('graduation_subject', $preparationDetail->graduation_subject) }}" required placeholder="Enter your graduation subject">
            @error('graduation_subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Optional Subject -->
        <div class="mb-3">
            <label for="optional_subject" class="form-label">Optional Subject</label>
            <input type="text" name="optional_subject" id="optional_subject" class="form-control @error('optional_subject') is-invalid @enderror" value="{{ old('optional_subject', $preparationDetail->optional_subject) }}" required placeholder="Enter your optional subject">
            @error('optional_subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Start Year -->
        <div class="mb-3">
            <label for="start_year" class="form-label">Start Year</label>
            <input type="text" name="start_year" id="start_year" class="form-control @error('start_year') is-invalid @enderror" value="{{ old('start_year', $preparationDetail->start_year) }}" required placeholder="Enter your start year">
            @error('start_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Has Coaching -->
        <div class="mb-3">
            <label for="has_coaching" class="form-label">Have you attended coaching?</label>
            <select name="has_coaching" id="has_coaching" class="form-select @error('has_coaching') is-invalid @enderror" required>
                <option value="1" {{ old('has_coaching', $preparationDetail->has_coaching) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('has_coaching', $preparationDetail->has_coaching) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('has_coaching')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Coaching Institute -->
        <div class="mb-3">
            <label for="coaching_institute" class="form-label">Coaching Institute</label>
            <input type="text" name="coaching_institute" id="coaching_institute" class="form-control @error('coaching_institute') is-invalid @enderror" value="{{ old('coaching_institute', $preparationDetail->coaching_institute) }}" placeholder="Enter the coaching institute name">
            @error('coaching_institute')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Coaching Year -->
        <div class="mb-3">
            <label for="coaching_year" class="form-label">Coaching Year</label>
            <input type="text" name="coaching_year" id="coaching_year" class="form-control @error('coaching_year') is-invalid @enderror" value="{{ old('coaching_year', $preparationDetail->coaching_year) }}" placeholder="Enter the year of coaching">
            @error('coaching_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Attempt Count -->
        <div class="mb-3">
            <label for="attempt_count" class="form-label">Attempt Count</label>
            <input type="number" name="attempt_count" id="attempt_count" class="form-control @error('attempt_count') is-invalid @enderror" value="{{ old('attempt_count', $preparationDetail->attempt_count) }}" required placeholder="Enter the number of attempts">
            @error('attempt_count')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cleared Prelims -->
        <div class="mb-3">
            <label for="cleared_prelims" class="form-label">Cleared Prelims?</label>
            <select name="cleared_prelims" id="cleared_prelims" class="form-select @error('cleared_prelims') is-invalid @enderror" required>
                <option value="1" {{ old('cleared_prelims', $preparationDetail->cleared_prelims) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('cleared_prelims', $preparationDetail->cleared_prelims) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('cleared_prelims')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cleared Prelims Year -->
        <div class="mb-3">
            <label for="cleared_prelims_year" class="form-label">Year Cleared Prelims</label>
            <input type="text" name="cleared_prelims_year" id="cleared_prelims_year" class="form-control @error('cleared_prelims_year') is-invalid @enderror" value="{{ old('cleared_prelims_year', $preparationDetail->cleared_prelims_year) }}" placeholder="Enter the year you cleared Prelims">
            @error('cleared_prelims_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cleared Mains -->
        <div class="mb-3">
            <label for="cleared_mains" class="form-label">Cleared Mains?</label>
            <select name="cleared_mains" id="cleared_mains" class="form-select @error('cleared_mains') is-invalid @enderror" required>
                <option value="1" {{ old('cleared_mains', $preparationDetail->cleared_mains) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('cleared_mains', $preparationDetail->cleared_mains) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('cleared_mains')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cleared Mains Year -->
        <div class="mb-3">
            <label for="cleared_mains_year" class="form-label">Year Cleared Mains</label>
            <input type="text" name="cleared_mains_year" id="cleared_mains_year" class="form-control @error('cleared_mains_year') is-invalid @enderror" value="{{ old('cleared_mains_year', $preparationDetail->cleared_mains_year) }}" placeholder="Enter the year you cleared Mains">
            @error('cleared_mains_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Marks in Attempts -->
        <div class="mb-3">
            <label for="marks_in_attempts" class="form-label">Marks in Attempts</label>
            <input type="text" name="marks_in_attempts" id="marks_in_attempts" class="form-control @error('marks_in_attempts') is-invalid @enderror" value="{{ old('marks_in_attempts', $preparationDetail->marks_in_attempts) }}" placeholder="Enter marks for each attempt">
            @error('marks_in_attempts')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Revision Count -->
        <div class="mb-3">
            <label for="revision_count" class="form-label">Revision Count</label>
            <input type="number" name="revision_count" id="revision_count" class="form-control @error('revision_count') is-invalid @enderror" value="{{ old('revision_count', $preparationDetail->revision_count) }}" placeholder="Enter number of revisions">
            @error('revision_count')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Strong Subjects -->
        <div class="mb-3">
            <label for="strong_subjects" class="form-label">Strong Subjects</label>
            <input type="text" name="strong_subjects" id="strong_subjects" class="form-control @error('strong_subjects') is-invalid @enderror" value="{{ old('strong_subjects', $preparationDetail->strong_subjects) }}" placeholder="Enter your strong subjects">
            @error('strong_subjects')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Challenging Subjects -->
        <div class="mb-3">
            <label for="challenging_subjects" class="form-label">Challenging Subjects</label>
            <input type="text" name="challenging_subjects" id="challenging_subjects" class="form-control @error('challenging_subjects') is-invalid @enderror" value="{{ old('challenging_subjects', $preparationDetail->challenging_subjects) }}" placeholder="Enter your challenging subjects">
            @error('challenging_subjects')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Comfortable Prelims Subjects -->
        <div class="mb-3">
            <label for="comfortable_prelims_subjects" class="form-label">Comfortable Prelims Subjects</label>
            <input type="text" name="comfortable_prelims_subjects" id="comfortable_prelims_subjects" class="form-control @error('comfortable_prelims_subjects') is-invalid @enderror" value="{{ old('comfortable_prelims_subjects', $preparationDetail->comfortable_prelims_subjects) }}" placeholder="Enter comfortable subjects for Prelims">
            @error('comfortable_prelims_subjects')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Struggle Prelims Subjects -->
        <div class="mb-3">
            <label for="struggle_prelims_subjects" class="form-label">Struggling Prelims Subjects</label>
            <input type="text" name="struggle_prelims_subjects" id="struggle_prelims_subjects" class="form-control @error('struggle_prelims_subjects') is-invalid @enderror" value="{{ old('struggle_prelims_subjects', $preparationDetail->struggle_prelims_subjects) }}" placeholder="Enter subjects you're struggling with for Prelims">
            @error('struggle_prelims_subjects')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Primary Current Affairs Source -->
        <div class="mb-3">
            <label for="primary_current_affairs_source" class="form-label">Primary Current Affairs Source</label>
            <input type="text" name="primary_current_affairs_source" id="primary_current_affairs_source" class="form-control @error('primary_current_affairs_source') is-invalid @enderror" value="{{ old('primary_current_affairs_source', $preparationDetail->primary_current_affairs_source) }}" placeholder="Enter your primary current affairs source">
            @error('primary_current_affairs_source')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Current Affairs Study Hours -->
        <div class="mb-3">
            <label for="current_affairs_study_hours" class="form-label">Current Affairs Study Hours</label>
            <input type="number" name="current_affairs_study_hours" id="current_affairs_study_hours" class="form-control @error('current_affairs_study_hours') is-invalid @enderror" value="{{ old('current_affairs_study_hours', $preparationDetail->current_affairs_study_hours) }}" placeholder="Enter the number of hours spent on current affairs">
            @error('current_affairs_study_hours')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Full Prelims Reading Completed -->
        <div class="mb-3">
            <label for="full_prelims_reading_completed" class="form-label">Full Prelims Reading Completed?</label>
            <select name="full_prelims_reading_completed" id="full_prelims_reading_completed" class="form-select @error('full_prelims_reading_completed') is-invalid @enderror" required>
                <option value="1" {{ old('full_prelims_reading_completed', $preparationDetail->full_prelims_reading_completed) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('full_prelims_reading_completed', $preparationDetail->full_prelims_reading_completed) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('full_prelims_reading_completed')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Revision Before Prelims -->
        <div class="mb-3">
            <label for="revision_before_prelims" class="form-label">Revision Before Prelims</label>
            <input type="text" name="revision_before_prelims" id="revision_before_prelims" class="form-control @error('revision_before_prelims') is-invalid @enderror" value="{{ old('revision_before_prelims', $preparationDetail->revision_before_prelims) }}" placeholder="Describe your revision plan before Prelims">
            @error('revision_before_prelims')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Revision Time per Day -->
        <div class="mb-3">
            <label for="revision_time_per_day" class="form-label">Revision Time per Day</label>
            <input type="number" name="revision_time_per_day" id="revision_time_per_day" class="form-control @error('revision_time_per_day') is-invalid @enderror" value="{{ old('revision_time_per_day', $preparationDetail->revision_time_per_day) }}" placeholder="Enter your revision time per day (in hours)">
            @error('revision_time_per_day')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Revision Method -->
        <div class="mb-3">
            <label for="revision_method" class="form-label">Revision Method</label>
            <input type="text" name="revision_method" id="revision_method" class="form-control @error('revision_method') is-invalid @enderror" value="{{ old('revision_method', $preparationDetail->revision_method) }}" placeholder="Enter your revision method">
            @error('revision_method')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Avoid Past Mistakes -->
        <div class="mb-3">
            <label for="avoid_past_mistakes" class="form-label">Avoid Past Mistakes</label>
            <input type="text" name="avoid_past_mistakes" id="avoid_past_mistakes" class="form-control @error('avoid_past_mistakes') is-invalid @enderror" value="{{ old('avoid_past_mistakes', $preparationDetail->avoid_past_mistakes) }}" placeholder="Describe how you avoid past mistakes">
            @error('avoid_past_mistakes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- UPSC PYQ Analysis completed -->
        <div class="mb-3">
            <label for="upsc_pyq_analysis_completed" class="form-label">Review PYQ Frequency</label>
            <input type="text" name="upsc_pyq_analysis_completed" id="upsc_pyq_analysis_completed" class="form-control @error('upsc_pyq_analysis_completed') is-invalid @enderror" value="{{ old('upsc_pyq_analysis_completed', $preparationDetail->upsc_pyq_analysis_completed) }}" placeholder="Enter the frequency of reviewing past year questions">
            @error('upsc_pyq_analysis_completed')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Review PYQ Frequency -->
        <div class="mb-3">
            <label for="review_pyq_frequency" class="form-label">Review PYQ Frequency</label>
            <input type="text" name="review_pyq_frequency" id="review_pyq_frequency" class="form-control @error('review_pyq_frequency') is-invalid @enderror" value="{{ old('review_pyq_frequency', $preparationDetail->review_pyq_frequency) }}" placeholder="Enter the frequency of reviewing past year questions">
            @error('review_pyq_frequency')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Solved Practice Questions after each Chapter -->
        <div class="mb-3">
            <label for="solved_practice_questions_after_each_chapter" class="form-label">Solved Practice Questions after each Chapter</label>
            <input type="text" name="solved_practice_questions_after_each_chapter" id="solved_practice_questions_after_each_chapter" class="form-control @error('solved_practice_questions_after_each_chapter') is-invalid @enderror" value="{{ old('solved_practice_questions_after_each_chapter', $preparationDetail->solved_practice_questions_after_each_chapter) }}" placeholder="Describe how you solve practice questions after each chapter">
            @error('solved_practice_questions_after_each_chapter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Note Preparation for PYQs -->
        <div class="mb-3">
            <label for="note_preparation_for_pyqs" class="form-label">Note Preparation for PYQs</label>
            <input type="text" name="note_preparation_for_pyqs" id="note_preparation_for_pyqs" class="form-control @error('note_preparation_for_pyqs') is-invalid @enderror" value="{{ old('note_preparation_for_pyqs', $preparationDetail->note_preparation_for_pyqs) }}" placeholder="Describe your note preparation for past year questions">
            @error('note_preparation_for_pyqs')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Preparation Detail</button>
        <a href="{{ route('preparation_details.index') }}" class="btn btn-secondary">Cancel</a>
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
