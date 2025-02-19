<!-- resources/views/steps/step6.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 6: Additional Preparation Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 6]) }}">
                @csrf
                <div class="row g-3">
                    <!-- YouTube Channels Followed -->
                    <div class="col-12">
                        <label class="form-label">Which YouTube channels do you follow for your preparation?</label>
                        <textarea class="form-control @error('youtube_channels_followed') is-invalid @enderror" 
                                  name="youtube_channels_followed" rows="2">{{ old('youtube_channels_followed') }}</textarea>
                        @error('youtube_channels_followed')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Other Coaching Programs -->
                    <div class="col-12">
                        <label class="form-label">Presently other than SNTCSSC are you part of any other coaching programme?</label>
                        <input type="text" class="form-control @error('other_coaching_programs') is-invalid @enderror"
                               name="other_coaching_programs" value="{{ old('other_coaching_programs') }}" maxlength="10">
                        @error('other_coaching_programs')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Coaching Name -->
                    <div class="col-12">
                        <label class="form-label">If yes give the coaching name</label>
                        <input type="text" class="form-control @error('coaching_name') is-invalid @enderror"
                               name="coaching_name" value="{{ old('coaching_name') }}">
                        @error('coaching_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Coaching Program Details -->
                    <div class="col-12">
                        <label class="form-label">Coaching Program Details</label>
                        <textarea class="form-control @error('coaching_program_details') is-invalid @enderror"
                                  name="coaching_program_details" rows="2">{{ old('coaching_program_details') }}</textarea>
                        @error('coaching_program_details')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Revision Before Prelims Count -->
                    <div class="col-12">
                        <label class="form-label">How many revisions did you complete before attempting the Prelims last year?</label>
                        <input type="number" class="form-control @error('revision_before_prelims_count') is-invalid @enderror"
                               name="revision_before_prelims_count" value="{{ old('revision_before_prelims_count') }}" required>
                        @error('revision_before_prelims_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Experience with Stress and Anxiety -->
                    <div class="col-12">
                        <label class="form-label">Did you experience stress, anxiety, or nervousness while taking mock tests or the UPSC Prelims? Briefly explain.</label>
                        <textarea class="form-control @error('experience_stress_anxiety') is-invalid @enderror"
                                  name="experience_stress_anxiety" rows="2">{{ old('experience_stress_anxiety') }}</textarea>
                        @error('experience_stress_anxiety')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Positive Takeaways from Mock Tests -->
                    <div class="col-12">
                        <label class="form-label">What positive takeaways have you gained from your mock tests or the UPSC Prelims?</label>
                        <textarea class="form-control @error('positive_takeaways_from_mock_tests') is-invalid @enderror"
                                  name="positive_takeaways_from_mock_tests" rows="2">{{ old('positive_takeaways_from_mock_tests') }}</textarea>
                        @error('positive_takeaways_from_mock_tests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mistakes After Mock Tests -->
                    <div class="col-12">
                        <label class="form-label">What mistakes have you identified after taking mock tests or the UPSC Prelims?</label>
                        <textarea class="form-control @error('mistakes_after_mock_tests') is-invalid @enderror"
                                  name="mistakes_after_mock_tests" rows="2">{{ old('mistakes_after_mock_tests') }}</textarea>
                        @error('mistakes_after_mock_tests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Specific Strategy for Tests -->
                    <div class="col-12">
                        <label class="form-label">Did you follow any specific strategy for mock tests or the UPSC Prelims?</label>
                        <textarea class="form-control @error('specific_strategy_for_tests') is-invalid @enderror"
                                  name="specific_strategy_for_tests" rows="2">{{ old('specific_strategy_for_tests') }}</textarea>
                        @error('specific_strategy_for_tests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Daily Study Hours -->
                    <div class="col-12">
                        <label class="form-label">How many hours do you study daily?</label>
                        <input type="number" class="form-control @error('daily_study_hours') is-invalid @enderror"
                               name="daily_study_hours" value="{{ old('daily_study_hours') }}" min="1">
                        @error('daily_study_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Study Schedule -->
                    <div class="col-12">
                        <label class="form-label">Write down your daily study schedule.</label>
                        <textarea class="form-control @error('study_schedule') is-invalid @enderror"
                                  name="study_schedule" rows="2">{{ old('study_schedule') }}</textarea>
                        @error('study_schedule')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save and Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
