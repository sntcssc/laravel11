@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit Preparation</h1>
        <form action="{{ route('preparations.update', $preparation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $preparation->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->first_name }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="unique_id" class="form-label">Unique ID</label>
                <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" id="unique_id" value="{{ old('unique_id', $preparation->unique_id) }}">
                @error('unique_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="youtube_channels_followed" class="form-label">Youtube Channels Followed</label>
                <textarea class="form-control @error('youtube_channels_followed') is-invalid @enderror" name="youtube_channels_followed" id="youtube_channels_followed">{{ old('youtube_channels_followed', $preparation->youtube_channels_followed) }}</textarea>
                @error('youtube_channels_followed')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="other_coaching_programs" class="form-label">Other Coaching Programs</label>
                <select name="other_coaching_programs" id="other_coaching_programs" class="form-control @error('other_coaching_programs') is-invalid @enderror">
                    <option value="yes" {{ old('other_coaching_programs', $preparation->other_coaching_programs) == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ old('other_coaching_programs', $preparation->other_coaching_programs) == 'no' ? 'selected' : '' }}>No</option>
                </select>
                @error('other_coaching_programs')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coaching_name" class="form-label">Coaching Name</label>
                <input type="text" class="form-control @error('coaching_name') is-invalid @enderror" name="coaching_name" id="coaching_name" value="{{ old('coaching_name', $preparation->coaching_name) }}">
                @error('coaching_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coaching_program_details" class="form-label">Coaching Program Details</label>
                <textarea class="form-control @error('coaching_program_details') is-invalid @enderror" name="coaching_program_details" id="coaching_program_details">{{ old('coaching_program_details', $preparation->coaching_program_details) }}</textarea>
                @error('coaching_program_details')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="revision_before_prelims_count" class="form-label">Revision Before Prelims Count</label>
                <input type="number" class="form-control @error('revision_before_prelims_count') is-invalid @enderror" name="revision_before_prelims_count" id="revision_before_prelims_count" value="{{ old('revision_before_prelims_count', $preparation->revision_before_prelims_count) }}">
                @error('revision_before_prelims_count')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="experience_stress_anxiety" class="form-label">Experience with Stress/Anxiety</label>
                <textarea class="form-control @error('experience_stress_anxiety') is-invalid @enderror" name="experience_stress_anxiety" id="experience_stress_anxiety">{{ old('experience_stress_anxiety', $preparation->experience_stress_anxiety) }}</textarea>
                @error('experience_stress_anxiety')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="positive_takeaways_from_mock_tests" class="form-label">Positive Takeaways from Mock Tests</label>
                <textarea class="form-control @error('positive_takeaways_from_mock_tests') is-invalid @enderror" name="positive_takeaways_from_mock_tests" id="positive_takeaways_from_mock_tests">{{ old('positive_takeaways_from_mock_tests', $preparation->positive_takeaways_from_mock_tests) }}</textarea>
                @error('positive_takeaways_from_mock_tests')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mistakes_after_mock_tests" class="form-label">Mistakes After Mock Tests</label>
                <textarea class="form-control @error('mistakes_after_mock_tests') is-invalid @enderror" name="mistakes_after_mock_tests" id="mistakes_after_mock_tests">{{ old('mistakes_after_mock_tests', $preparation->mistakes_after_mock_tests) }}</textarea>
                @error('mistakes_after_mock_tests')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="specific_strategy_for_tests" class="form-label">Specific Strategy for Tests</label>
                <textarea class="form-control @error('specific_strategy_for_tests') is-invalid @enderror" name="specific_strategy_for_tests" id="specific_strategy_for_tests">{{ old('specific_strategy_for_tests', $preparation->specific_strategy_for_tests) }}</textarea>
                @error('specific_strategy_for_tests')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="daily_study_hours" class="form-label">Daily Study Hours</label>
                <input type="number" class="form-control @error('daily_study_hours') is-invalid @enderror" name="daily_study_hours" id="daily_study_hours" value="{{ old('daily_study_hours', $preparation->daily_study_hours) }}">
                @error('daily_study_hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="study_schedule" class="form-label">Study Schedule</label>
                <textarea class="form-control @error('study_schedule') is-invalid @enderror" name="study_schedule" id="study_schedule">{{ old('study_schedule', $preparation->study_schedule) }}</textarea>
                @error('study_schedule')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Preparation</button>
        </form>
    </div>
@endsection
