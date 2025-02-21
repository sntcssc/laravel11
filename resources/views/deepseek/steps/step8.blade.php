<!-- resources/views/steps/step8.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 8: How much you know your Special Focus Group (SFG) program?</div>
        <div class="card-body">
            <form method="POST" id="stepForm" action="{{ route('form.step', ['step' => 8]) }}">
                @csrf
                <div class="row g-3">

                    <!-- Key Features of SFG Program -->
                    <div class="col-12">
                        <label class="form-label">Write down the key features of the Special Focus Group (SFG) program.</label>
                        <textarea class="form-control @error('key_features_of_sfg_program') is-invalid @enderror" 
                                  name="key_features_of_sfg_program" rows="2" required>{{ old('key_features_of_sfg_program') }}</textarea>
                        @error('key_features_of_sfg_program')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Ways SFG Will Help in Exam -->
                    <div class="col-12">
                        <label class="form-label">List five ways in which the SFG program will help you clear your exam this year.</label>
                        <textarea class="form-control @error('ways_sfg_will_help_in_exam') is-invalid @enderror" 
                                  name="ways_sfg_will_help_in_exam" rows="2" required>{{ old('ways_sfg_will_help_in_exam') }}</textarea>
                        @error('ways_sfg_will_help_in_exam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Regular Analysis of Prelims Performance -->
                    <div class="col-12">
                        <label class="form-label">Do you regularly analyze your Prelims performance after every test?</label>
                        <textarea class="form-control @error('regular_analysis_of_prelims_performance') is-invalid @enderror" 
                                  name="regular_analysis_of_prelims_performance" rows="2">{{ old('regular_analysis_of_prelims_performance') }}</textarea>
                        @error('regular_analysis_of_prelims_performance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Benefits from Prelims Analysis -->
                    <div class="col-12">
                        <label class="form-label">What benefits do you gain from conducting a Prelims performance analysis?</label>
                        <textarea class="form-control @error('benefits_from_prelims_analysis') is-invalid @enderror" 
                                  name="benefits_from_prelims_analysis" rows="2">{{ old('benefits_from_prelims_analysis') }}</textarea>
                        @error('benefits_from_prelims_analysis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Identifying Weak Areas After Tests -->
                    <div class="col-12">
                        <label class="form-label">Are you identifying your weak areas after each test?</label>
                        <textarea class="form-control @error('identifying_weak_areas_after_tests') is-invalid @enderror" 
                                  name="identifying_weak_areas_after_tests" rows="2">{{ old('identifying_weak_areas_after_tests') }}</textarea>
                        @error('identifying_weak_areas_after_tests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Working to Eliminate Weak Areas -->
                    <div class="col-12">
                        <label class="form-label">How are you working to eliminate your weak areas?</label>
                        <textarea class="form-control @error('working_to_eliminate_weak_areas') is-invalid @enderror" 
                                  name="working_to_eliminate_weak_areas" rows="2">{{ old('working_to_eliminate_weak_areas') }}</textarea>
                        @error('working_to_eliminate_weak_areas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Reading Test Explanations -->
                    <div class="col-12">
                        <label class="form-label">Do you thoroughly read the test explanations?</label>
                        <textarea class="form-control @error('reading_test_explanations') is-invalid @enderror" 
                                  name="reading_test_explanations" rows="2">{{ old('reading_test_explanations') }}</textarea>
                        @error('reading_test_explanations')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Taking Notes from Explanations -->
                    <div class="col-12">
                        <label class="form-label">Do you take notes from the test explanations?</label>
                        <textarea class="form-control @error('taking_notes_from_explanations') is-invalid @enderror" 
                                  name="taking_notes_from_explanations" rows="2">{{ old('taking_notes_from_explanations') }}</textarea>
                        @error('taking_notes_from_explanations')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Regular Test Participation -->
                    <div class="col-12">
                        <label class="form-label">Are you attempting all the tests regularly?</label>
                        <textarea class="form-control @error('regular_test_participation') is-invalid @enderror" 
                                  name="regular_test_participation" rows="2">{{ old('regular_test_participation') }}</textarea>
                        @error('regular_test_participation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Test Participation Challenges -->
                    <div class="col-12">
                        <label class="form-label">What are the reasons preventing you from taking tests consistently?</label>
                        <textarea class="form-control @error('test_participation_challenges') is-invalid @enderror" 
                                  name="test_participation_challenges" rows="2">{{ old('test_participation_challenges') }}</textarea>
                        @error('test_participation_challenges')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Overcoming Test Challenges -->
                    <div class="col-12">
                        <label class="form-label">How will you overcome these challenges to ensure regular test participation?</label>
                        <textarea class="form-control @error('overcoming_test_challenges') is-invalid @enderror" 
                                  name="overcoming_test_challenges" rows="2">{{ old('overcoming_test_challenges') }}</textarea>
                        @error('overcoming_test_challenges')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Highest Test Score -->
                    <div class="col-md-6">
                        <label class="form-label">What is your highest score so far in the tests I have conducted?</label>
                        <input type="number" class="form-control @error('highest_test_score') is-invalid @enderror" 
                               name="highest_test_score" value="{{ old('highest_test_score') }}" required>
                        @error('highest_test_score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Lowest Test Score -->
                    <div class="col-md-6">
                        <label class="form-label">What is your lowest score so far in the tests I have conducted?</label>
                        <input type="number" class="form-control @error('lowest_test_score') is-invalid @enderror" 
                               name="lowest_test_score" value="{{ old('lowest_test_score') }}">
                        @error('lowest_test_score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Average Test Score -->
                    <div class="col-md-6">
                        <label class="form-label">What is your average score across all the tests I have conducted?</label>
                        <input type="number" class="form-control @error('average_test_score') is-invalid @enderror" 
                               name="average_test_score" value="{{ old('average_test_score') }}">
                        @error('average_test_score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Confidence Level -->
                    <div class="col-md-6">
                        <label class="form-label">Do you believe you will clear the Prelims this year.</label>
                        <select class="form-select @error('belief_in_clearing_prelims_this_year') is-invalid @enderror" 
                                name="belief_in_clearing_prelims_this_year" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('belief_in_clearing_prelims_this_year') == 'yes' ? 'selected' : '' }}>High Confidence</option>
                            <option value="no" {{ old('belief_in_clearing_prelims_this_year') == 'no' ? 'selected' : '' }}>Need Improvement</option>
                        </select>
                        @error('belief_in_clearing_prelims_this_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" id="submitButton" class="btn btn-primary mt-3">
                            <span id="spinner"></span>
                            <span id="submitText">Submit</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
