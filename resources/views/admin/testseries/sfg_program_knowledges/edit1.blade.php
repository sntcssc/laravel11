@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit SFG Program Knowledge</h2>
    <form action="{{ route('sfg_program_knowledges.update', $programKnowledge->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Student Selection -->
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">Select a Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $programKnowledge->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Unique ID -->
        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control" value="{{ old('unique_id', $programKnowledge->unique_id) }}" required>
            @error('unique_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Key Features of SFG Program -->
        <div class="mb-3">
            <label for="key_features_of_sfg_program" class="form-label">Key Features of SFG Program</label>
            <textarea name="key_features_of_sfg_program" id="key_features_of_sfg_program" class="form-control" required>{{ old('key_features_of_sfg_program', $programKnowledge->key_features_of_sfg_program) }}</textarea>
            @error('key_features_of_sfg_program')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Ways SFG Will Help in Exam -->
        <div class="mb-3">
            <label for="ways_sfg_will_help_in_exam" class="form-label">Ways SFG Will Help in Exam</label>
            <textarea name="ways_sfg_will_help_in_exam" id="ways_sfg_will_help_in_exam" class="form-control" required>{{ old('ways_sfg_will_help_in_exam', $programKnowledge->ways_sfg_will_help_in_exam) }}</textarea>
            @error('ways_sfg_will_help_in_exam')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Regular Analysis of Prelims Performance -->
        <div class="mb-3">
            <label for="regular_analysis_of_prelims_performance" class="form-label">Regular Analysis of Prelims Performance</label>
            <input type="checkbox" name="regular_analysis_of_prelims_performance" id="regular_analysis_of_prelims_performance" {{ old('regular_analysis_of_prelims_performance', $programKnowledge->regular_analysis_of_prelims_performance) ? 'checked' : '' }}>
            @error('regular_analysis_of_prelims_performance')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Benefits from Prelims Analysis -->
        <div class="mb-3">
            <label for="benefits_from_prelims_analysis" class="form-label">Benefits from Prelims Analysis</label>
            <textarea name="benefits_from_prelims_analysis" id="benefits_from_prelims_analysis" class="form-control" required>{{ old('benefits_from_prelims_analysis', $programKnowledge->benefits_from_prelims_analysis) }}</textarea>
            @error('benefits_from_prelims_analysis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Identifying Weak Areas After Tests -->
        <div class="mb-3">
            <label for="identifying_weak_areas_after_tests" class="form-label">Identifying Weak Areas After Tests</label>
            <input type="checkbox" name="identifying_weak_areas_after_tests" id="identifying_weak_areas_after_tests" {{ old('identifying_weak_areas_after_tests', $programKnowledge->identifying_weak_areas_after_tests) ? 'checked' : '' }}>
            @error('identifying_weak_areas_after_tests')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Working to Eliminate Weak Areas -->
        <div class="mb-3">
            <label for="working_to_eliminate_weak_areas" class="form-label">Working to Eliminate Weak Areas</label>
            <textarea name="working_to_eliminate_weak_areas" id="working_to_eliminate_weak_areas" class="form-control" required>{{ old('working_to_eliminate_weak_areas', $programKnowledge->working_to_eliminate_weak_areas) }}</textarea>
            @error('working_to_eliminate_weak_areas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Reading Test Explanations -->
        <div class="mb-3">
            <label for="reading_test_explanations" class="form-label">Reading Test Explanations</label>
            <input type="checkbox" name="reading_test_explanations" id="reading_test_explanations" {{ old('reading_test_explanations', $programKnowledge->reading_test_explanations) ? 'checked' : '' }}>
            @error('reading_test_explanations')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Taking Notes from Explanations -->
        <div class="mb-3">
            <label for="taking_notes_from_explanations" class="form-label">Taking Notes from Explanations</label>
            <input type="checkbox" name="taking_notes_from_explanations" id="taking_notes_from_explanations" {{ old('taking_notes_from_explanations', $programKnowledge->taking_notes_from_explanations) ? 'checked' : '' }}>
            @error('taking_notes_from_explanations')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Regular Test Participation -->
        <div class="mb-3">
            <label for="regular_test_participation" class="form-label">Regular Test Participation</label>
            <input type="checkbox" name="regular_test_participation" id="regular_test_participation" {{ old('regular_test_participation', $programKnowledge->regular_test_participation) ? 'checked' : '' }}>
            @error('regular_test_participation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Test Participation Challenges -->
        <div class="mb-3">
            <label for="test_participation_challenges" class="form-label">Test Participation Challenges</label>
            <textarea name="test_participation_challenges" id="test_participation_challenges" class="form-control" required>{{ old('test_participation_challenges', $programKnowledge->test_participation_challenges) }}</textarea>
            @error('test_participation_challenges')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Overcoming Test Challenges -->
        <div class="mb-3">
            <label for="overcoming_test_challenges" class="form-label">Overcoming Test Challenges</label>
            <textarea name="overcoming_test_challenges" id="overcoming_test_challenges" class="form-control" required>{{ old('overcoming_test_challenges', $programKnowledge->overcoming_test_challenges) }}</textarea>
            @error('overcoming_test_challenges')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Highest Test Score -->
        <div class="mb-3">
            <label for="highest_test_score" class="form-label">Highest Test Score</label>
            <input type="number" name="highest_test_score" id="highest_test_score" class="form-control" value="{{ old('highest_test_score', $programKnowledge->highest_test_score) }}" required>
            @error('highest_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Lowest Test Score -->
        <div class="mb-3">
            <label for="lowest_test_score" class="form-label">Lowest Test Score</label>
            <input type="number" name="lowest_test_score" id="lowest_test_score" class="form-control" value="{{ old('lowest_test_score', $programKnowledge->lowest_test_score) }}" required>
            @error('lowest_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Average Test Score -->
        <div class="mb-3">
            <label for="average_test_score" class="form-label">Average Test Score</label>
            <input type="number" step="0.01" name="average_test_score" id="average_test_score" class="form-control" value="{{ old('average_test_score', $programKnowledge->average_test_score) }}" required>
            @error('average_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Belief in Clearing Prelims -->
        <div class="mb-3">
            <label for="belief_in_clearing_prelims_this_year" class="form-label">Belief in Clearing Prelims This Year</label>
            <input type="checkbox" name="belief_in_clearing_prelims_this_year" id="belief_in_clearing_prelims_this_year" {{ old('belief_in_clearing_prelims_this_year', $programKnowledge->belief_in_clearing_prelims_this_year) ? 'checked' : '' }}>
            @error('belief_in_clearing_prelims_this_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
