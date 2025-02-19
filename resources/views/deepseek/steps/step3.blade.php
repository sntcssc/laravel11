<!-- resources/views/steps/step3.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container-fluid">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 3: Preparation Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 3]) }}">
                @csrf
                <div class="row g-3">
                    <!-- Highest Education Qualification -->
                    <div class="col-md-6">
                        <label class="form-label">Highest Educational Qualification</label>
                        <input type="text" class="form-control @error('highest_education_qualification') is-invalid @enderror" 
                               name="highest_education_qualification" value="{{ old('highest_education_qualification') }}" required>
                        @error('highest_education_qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Graduation Subject -->
                    <div class="col-md-6">
                        <label class="form-label">Graduation Subject</label>
                        <input type="text" class="form-control @error('graduation_subject') is-invalid @enderror" 
                               name="graduation_subject" value="{{ old('graduation_subject') }}" required>
                        @error('graduation_subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Optional Subject -->
                    <div class="col-md-6">
                        <label for="optional_subject" class="form-label">Optional Subject</label>
                        <select 
                            class="form-control @error('optional_subject') is-invalid @enderror" 
                            name="optional_subject" id="optional_subject" required>
                            <option value="" disabled selected>Select your optional subject</option>
                            <option value="Agriculture" {{ old('optional_subject') == 'Agriculture' ? 'selected' : '' }}>Agriculture</option>
                            <option value="Animal Husbandry and Veterinary Science" {{ old('optional_subject') == 'Animal Husbandry and Veterinary Science' ? 'selected' : '' }}>Animal Husbandry and Veterinary Science</option>
                            <option value="Anthropology" {{ old('optional_subject') == 'Anthropology' ? 'selected' : '' }}>Anthropology</option>
                            <option value="Bengali Literature" {{ old('optional_subject') == 'Bengali Literature' ? 'selected' : '' }}>Bengali Literature</option>
                            <option value="Botany" {{ old('optional_subject') == 'Botany' ? 'selected' : '' }}>Botany</option>
                            <option value="Chemistry" {{ old('optional_subject') == 'Chemistry' ? 'selected' : '' }}>Chemistry</option>
                            <option value="Civil Engineering" {{ old('optional_subject') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                            <option value="Commerce and Accountancy" {{ old('optional_subject') == 'Commerce and Accountancy' ? 'selected' : '' }}>Commerce and Accountancy</option>
                            <option value="Economics" {{ old('optional_subject') == 'Economics' ? 'selected' : '' }}>Economics</option>
                            <option value="Electrical Engineering" {{ old('optional_subject') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                            <option value="English Literature" {{ old('optional_subject') == 'English Literature' ? 'selected' : '' }}>English Literature</option>
                            <option value="Geography" {{ old('optional_subject') == 'Geography' ? 'selected' : '' }}>Geography</option>
                            <option value="Geology" {{ old('optional_subject') == 'Geology' ? 'selected' : '' }}>Geology</option>
                            <option value="Hindi Literature" {{ old('optional_subject') == 'Hindi Literature' ? 'selected' : '' }}>Hindi Literature</option>
                            <option value="History" {{ old('optional_subject') == 'History' ? 'selected' : '' }}>History</option>
                            <option value="Law" {{ old('optional_subject') == 'Law' ? 'selected' : '' }}>Law</option>
                            <option value="Management" {{ old('optional_subject') == 'Management' ? 'selected' : '' }}>Management</option>
                            <option value="Mathematics" {{ old('optional_subject') == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                            <option value="Mechanical Engineering" {{ old('optional_subject') == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                            <option value="Medical Science" {{ old('optional_subject') == 'Medical Science' ? 'selected' : '' }}>Medical Science</option>
                            <option value="Philosophy" {{ old('optional_subject') == 'Philosophy' ? 'selected' : '' }}>Philosophy</option>
                            <option value="Physics" {{ old('optional_subject') == 'Physics' ? 'selected' : '' }}>Physics</option>
                            <option value="Political Science and International Relations" {{ old('optional_subject') == 'Political Science and International Relations' ? 'selected' : '' }}>Political Science and International Relations</option>
                            <option value="Psychology" {{ old('optional_subject') == 'Psychology' ? 'selected' : '' }}>Psychology</option>
                            <option value="Public Administration" {{ old('optional_subject') == 'Public Administration' ? 'selected' : '' }}>Public Administration</option>
                            <option value="Sociology" {{ old('optional_subject') == 'Sociology' ? 'selected' : '' }}>Sociology</option>
                            <option value="Statistics" {{ old('optional_subject') == 'Statistics' ? 'selected' : '' }}>Statistics</option>
                            <option value="Urdu" {{ old('optional_subject') == 'Urdu' ? 'selected' : '' }}>Urdu</option>
                            <option value="Zoology" {{ old('optional_subject') == 'Zoology' ? 'selected' : '' }}>Zoology</option>
                        </select>
                        @error('optional_subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Start Year -->
                    <div class="col-md-6">
                        <label class="form-label">When did you start preparing for the UPSC exam? (Year)</label>
                        <input type="number" class="form-control @error('start_year') is-invalid @enderror" 
                               name="start_year" value="{{ old('start_year') }}" required>
                        @error('start_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Has Coaching -->
                    <div class="col-md-6">
                        <label class="form-label">Have you taken coaching? </label>
                        <select class="form-select @error('has_coaching') is-invalid @enderror" 
                                name="has_coaching" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('has_coaching') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('has_coaching') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('has_coaching')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Coaching Institute -->
                    <div class="col-md-6">
                        <label class="form-label">If yes, from which institute</label>
                        <input type="text" class="form-control @error('coaching_institute') is-invalid @enderror" 
                               name="coaching_institute" value="{{ old('coaching_institute') }}">
                        @error('coaching_institute')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Coaching Year -->
                    <div class="col-md-6">
                        <label class="form-label">in which year (Coaching Year)</label>
                        <input type="number" class="form-control @error('coaching_year') is-invalid @enderror" 
                               name="coaching_year" value="{{ old('coaching_year') }}">
                        @error('coaching_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Attempt Count -->
                    <div class="col-md-6">
                        <label class="form-label">How many attempts have you made so far?</label>
                        <input type="number" class="form-control @error('attempt_count') is-invalid @enderror" 
                               name="attempt_count" value="{{ old('attempt_count') }}" required>
                        @error('attempt_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Cleared Prelims -->
                    <div class="col-md-6">
                        <label class="form-label">Have you cleared the Prelims?</label>
                        <select class="form-select @error('cleared_prelims') is-invalid @enderror" 
                                name="cleared_prelims" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('cleared_prelims') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('cleared_prelims') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('cleared_prelims')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Cleared Prelims Year -->
                    <div class="col-md-6">
                        <label class="form-label">If yes, in which year(s)?</label>
                        <input type="number" class="form-control @error('cleared_prelims_year') is-invalid @enderror" 
                               name="cleared_prelims_year" value="{{ old('cleared_prelims_year') }}">
                        @error('cleared_prelims_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Cleared Mains -->
                    <div class="col-md-6">
                        <label class="form-label">Have you cleared the Mains?</label>
                        <select class="form-select @error('cleared_mains') is-invalid @enderror" 
                                name="cleared_mains" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('cleared_mains') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('cleared_mains') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('cleared_mains')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Cleared Mains Year -->
                    <div class="col-md-6">
                        <label class="form-label">If yes, in which year(s)?</label>
                        <input type="number" class="form-control @error('cleared_mains_year') is-invalid @enderror" 
                               name="cleared_mains_year" value="{{ old('cleared_mains_year') }}">
                        @error('cleared_mains_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Marks in Attempts -->
                    <div class="col-md-6">
                        <label class="form-label">Details of marks obtained in each UPSC attempt</label>
                        <input type="text" class="form-control @error('marks_in_attempts') is-invalid @enderror" 
                               name="marks_in_attempts" value="{{ old('marks_in_attempts') }}">
                        @error('marks_in_attempts')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Revision Count -->
                    <div class="col-md-6">
                        <label class="form-label">How many times have you revised the basic books?</label>
                        <input type="number" class="form-control @error('revision_count') is-invalid @enderror" 
                               name="revision_count" value="{{ old('revision_count') }}">
                        @error('revision_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Strong Subjects -->
                    <div class="col-md-6">
                        <label class="form-label">Which three subjects are your strongest?</label>
                        <input type="text" class="form-control @error('strong_subjects') is-invalid @enderror" 
                               name="strong_subjects" value="{{ old('strong_subjects') }}">
                        @error('strong_subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Challenging Subjects -->
                    <div class="col-md-6">
                        <label class="form-label">Which three subjects do you find most challenging?</label>
                        <input type="text" class="form-control @error('challenging_subjects') is-invalid @enderror" 
                               name="challenging_subjects" value="{{ old('challenging_subjects') }}">
                        @error('challenging_subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Comfortable Prelims Subjects -->
                    <div class="col-md-6">
                        <label class="form-label">Which subjects in the Prelims syllabus do you feel most comfortable with?</label>
                        <input type="text" class="form-control @error('comfortable_prelims_subjects') is-invalid @enderror" 
                               name="comfortable_prelims_subjects" value="{{ old('comfortable_prelims_subjects') }}">
                        @error('comfortable_prelims_subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Struggle Prelims Subjects -->
                    <div class="col-md-6">
                        <label class="form-label">Which subjects in the Prelims syllabus do you struggle with?</label>
                        <input type="text" class="form-control @error('struggle_prelims_subjects') is-invalid @enderror" 
                               name="struggle_prelims_subjects" value="{{ old('struggle_prelims_subjects') }}">
                        @error('struggle_prelims_subjects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Primary Current Affairs Source -->
                    <div class="col-md-6">
                        <label class="form-label">What are your primary sources for Current Affairs?</label>
                        <input type="text" class="form-control @error('primary_current_affairs_source') is-invalid @enderror" 
                               name="primary_current_affairs_source" value="{{ old('primary_current_affairs_source') }}">
                        @error('primary_current_affairs_source')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Current Affairs Study Hours -->
                    <div class="col-md-6">
                        <label class="form-label">How many hours per day do you dedicate to Current Affairs?</label>
                        <input type="number" class="form-control @error('current_affairs_study_hours') is-invalid @enderror" 
                               name="current_affairs_study_hours" value="{{ old('current_affairs_study_hours') }}">
                        @error('current_affairs_study_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Full Prelims Reading Completed -->
                    <div class="col-md-6">
                        <label class="form-label">Have you completed at least one full reading of the Prelims syllabus?</label>
                        <select class="form-select @error('full_prelims_reading_completed') is-invalid @enderror" 
                                name="full_prelims_reading_completed" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('full_prelims_reading_completed') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('full_prelims_reading_completed') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('full_prelims_reading_completed')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Revision Before Prelims -->
                    <div class="col-md-6">
                        <label class="form-label">Were you able to revise all subjects before the Prelims in your previous attempt?</label>
                        <input type="text" class="form-control @error('revision_before_prelims') is-invalid @enderror" 
                               name="revision_before_prelims" value="{{ old('revision_before_prelims') }}">
                        @error('revision_before_prelims')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Revision Time Per Day -->
                    <div class="col-md-6">
                        <label class="form-label">Did you allocate specific time for revision in your daily schedule? If yes, mention the hours.</label>
                        <input type="number" class="form-control @error('revision_time_per_day') is-invalid @enderror" 
                               name="revision_time_per_day" value="{{ old('revision_time_per_day') }}">
                        @error('revision_time_per_day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Revision Method -->
                    <div class="col-md-6">
                        <label class="form-label">How do you revise your syllabus?</label>
                        <input type="text" class="form-control @error('revision_method') is-invalid @enderror" 
                               name="revision_method" value="{{ old('revision_method') }}">
                        @error('revision_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Avoid Past Mistakes -->
                    <div class="col-md-6">
                        <label class="form-label">How do you plan to avoid repeating past mistakes in your next attempt?</label>
                            <input type="text" class="form-control @error('avoid_past_mistakes') is-invalid @enderror" 
                                name="avoid_past_mistakes" value="{{ old('avoid_past_mistakes') }}" required>
                        @error('avoid_past_mistakes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Review Frequency -->
                    <div class="col-md-6">
                        <label class="form-label">How often do you review and analyze previous years’ UPSC questions?</label>
                            <input type="text" class="form-control @error('review_pyq_frequency') is-invalid @enderror" 
                                name="review_pyq_frequency" value="{{ old('review_pyq_frequency') }}" required>
                        @error('review_pyq_frequency')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Solved Practice Questions After Each Chapter -->
                    <div class="col-md-6">
                        <label class="form-label">Do you solve practice questions after studying each chapter?</label>
                        <select class="form-control @error('solved_practice_questions_after_each_chapter') is-invalid @enderror" name="solved_practice_questions_after_each_chapter">
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('solved_practice_questions_after_each_chapter') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('solved_practice_questions_after_each_chapter') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('solved_practice_questions_after_each_chapter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Note Preparation for PYQs -->
                    <div class="col-md-6">
                        <label class="form-label">Have you prepared notes on Theme, Micro theme, Options from the UPSC PYQs from the years 2013 to the present?</label>
                        <textarea class="form-control @error('note_preparation_for_pyqs') is-invalid @enderror"
                                  name="note_preparation_for_pyqs" rows="2">{{ old('note_preparation_for_pyqs') }}</textarea>
                        @error('note_preparation_for_pyqs')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
</div>
@endsection
