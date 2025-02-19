@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit SFG Program Knowledge</h2>
    <form action="{{ route('sfg_program_knowledges.update', $programKnowledge->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">Select a Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $programKnowledge->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->first_name }}
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" id="unique_id" class="form-control" value="{{ old('unique_id', $programKnowledge->unique_id) }}" required>
            @error('unique_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="key_features_of_sfg_program" class="form-label">Key Features of SFG Program</label>
            <textarea name="key_features_of_sfg_program" id="key_features_of_sfg_program" class="form-control" required>{{ old('key_features_of_sfg_program', $programKnowledge->key_features_of_sfg_program) }}</textarea>
            @error('key_features_of_sfg_program')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ways_sfg_will_help_in_exam" class="form-label">Ways SFG Will Help in Exam</label>
            <textarea name="ways_sfg_will_help_in_exam" id="ways_sfg_will_help_in_exam" class="form-control" required>{{ old('ways_sfg_will_help_in_exam', $programKnowledge->ways_sfg_will_help_in_exam) }}</textarea>
            @error('ways_sfg_will_help_in_exam')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Regular Analysis of Prelims Performance -->
        <div class="mb-3">
            <label for="regular_analysis_of_prelims_performance" class="form-label">Regular Analysis of Prelims Performance</label>
            <select name="regular_analysis_of_prelims_performance" id="regular_analysis_of_prelims_performance" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('regular_analysis_of_prelims_performance', $programKnowledge->regular_analysis_of_prelims_performance) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('regular_analysis_of_prelims_performance', $programKnowledge->regular_analysis_of_prelims_performance) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('regular_analysis_of_prelims_performance')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Identifying Weak Areas After Tests -->
        <div class="mb-3">
            <label for="identifying_weak_areas_after_tests" class="form-label">Identifying Weak Areas After Tests</label>
            <select name="identifying_weak_areas_after_tests" id="identifying_weak_areas_after_tests" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('identifying_weak_areas_after_tests', $programKnowledge->identifying_weak_areas_after_tests) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('identifying_weak_areas_after_tests', $programKnowledge->identifying_weak_areas_after_tests) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('identifying_weak_areas_after_tests')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="benefits_from_prelims_analysis" class="form-label">Benefits from Prelims Analysis</label>
            <textarea name="benefits_from_prelims_analysis" id="benefits_from_prelims_analysis" class="form-control" required>{{ old('benefits_from_prelims_analysis', $programKnowledge->benefits_from_prelims_analysis) }}</textarea>
            @error('benefits_from_prelims_analysis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="working_to_eliminate_weak_areas" class="form-label">Working to Eliminate Weak Areas</label>
            <textarea name="working_to_eliminate_weak_areas" id="working_to_eliminate_weak_areas" class="form-control" required>{{ old('working_to_eliminate_weak_areas', $programKnowledge->working_to_eliminate_weak_areas) }}</textarea>
            @error('working_to_eliminate_weak_areas')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Reading Test Explanations -->
        <div class="mb-3">
            <label for="reading_test_explanations" class="form-label">Reading Test Explanations</label>
            <select name="reading_test_explanations" id="reading_test_explanations" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('reading_test_explanations', $programKnowledge->reading_test_explanations) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('reading_test_explanations', $programKnowledge->reading_test_explanations) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('reading_test_explanations')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Taking Notes from Explanations -->
        <div class="mb-3">
            <label for="taking_notes_from_explanations" class="form-label">Taking Notes from Explanations</label>
            <select name="taking_notes_from_explanations" id="taking_notes_from_explanations" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('taking_notes_from_explanations', $programKnowledge->taking_notes_from_explanations) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('taking_notes_from_explanations', $programKnowledge->taking_notes_from_explanations) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('taking_notes_from_explanations')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Regular Test Participation -->
        <div class="mb-3">
            <label for="regular_test_participation" class="form-label">Regular Test Participation</label>
            <select name="regular_test_participation" id="regular_test_participation" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('regular_test_participation', $programKnowledge->regular_test_participation) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('regular_test_participation', $programKnowledge->regular_test_participation) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('regular_test_participation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="test_participation_challenges" class="form-label">Test Participation Challenges</label>
            <textarea name="test_participation_challenges" id="test_participation_challenges" class="form-control" required>{{ old('test_participation_challenges', $programKnowledge->test_participation_challenges) }}</textarea>
            @error('test_participation_challenges')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="overcoming_test_challenges" class="form-label">Overcoming Test Challenges</label>
            <textarea name="overcoming_test_challenges" id="overcoming_test_challenges" class="form-control" required>{{ old('overcoming_test_challenges', $programKnowledge->overcoming_test_challenges) }}</textarea>
            @error('overcoming_test_challenges')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="highest_test_score" class="form-label">Highest Test Score</label>
            <input type="number" name="highest_test_score" id="highest_test_score" class="form-control" value="{{ old('highest_test_score', $programKnowledge->highest_test_score) }}" required>
            @error('highest_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lowest_test_score" class="form-label">Lowest Test Score</label>
            <input type="number" name="lowest_test_score" id="lowest_test_score" class="form-control" value="{{ old('lowest_test_score', $programKnowledge->lowest_test_score) }}" required>
            @error('lowest_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="average_test_score" class="form-label">Average Test Score</label>
            <input type="number" step="0.01" name="average_test_score" id="average_test_score" class="form-control" value="{{ old('average_test_score', $programKnowledge->average_test_score) }}" required>
            @error('average_test_score')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown for Belief in Clearing Prelims This Year -->
        <div class="mb-3">
            <label for="belief_in_clearing_prelims_this_year" class="form-label">Belief in Clearing Prelims This Year</label>
            <select name="belief_in_clearing_prelims_this_year" id="belief_in_clearing_prelims_this_year" class="form-select" required>
                <option value="">Select</option>
                <option value="1" {{ old('belief_in_clearing_prelims_this_year', $programKnowledge->belief_in_clearing_prelims_this_year) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('belief_in_clearing_prelims_this_year', $programKnowledge->belief_in_clearing_prelims_this_year) == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('belief_in_clearing_prelims_this_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
