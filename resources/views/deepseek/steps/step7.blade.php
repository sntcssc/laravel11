<!-- resources/views/steps/step7.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 7: Your Personality</div>
        <div class="card-body">
            <form method="POST" id="stepForm" action="{{ route('form.step', ['step' => 7]) }}">
                @csrf
                <!-- Reason for Civil Services -->
                <div class="mb-3">
                    <label class="form-label">Why did you choose to prepare for the Civil Services?</label>
                    <textarea class="form-control @error('reason_for_civil_services') is-invalid @enderror" 
                              name="reason_for_civil_services" rows="2" required>{{ old('reason_for_civil_services') }}</textarea>
                    @error('reason_for_civil_services')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Essential Values for Topping -->
                <div class="mb-3">
                    <label class="form-label">In your opinion, what values and habits are essential for topping the Civil Services Examination?</label>
                    <textarea class="form-control @error('essential_values_for_topping') is-invalid @enderror" 
                              name="essential_values_for_topping" rows="2">{{ old('essential_values_for_topping') }}</textarea>
                    @error('essential_values_for_topping')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Motivation for Daily Effort -->
                <div class="mb-3">
                    <label class="form-label">What motivates you to give your best every day while preparing for this examination?</label>
                    <textarea class="form-control @error('motivation_for_daily_effort') is-invalid @enderror" 
                              name="motivation_for_daily_effort" rows="2">{{ old('motivation_for_daily_effort') }}</textarea>
                    @error('motivation_for_daily_effort')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Strengths in Clearing Exams -->
                <div class="mb-3">
                    <label class="form-label">What are your biggest strengths in relation to clearing this examination?</label>
                    <textarea class="form-control @error('strengths_in_clearing_exams') is-invalid @enderror" 
                              name="strengths_in_clearing_exams" rows="2" required>{{ old('strengths_in_clearing_exams') }}</textarea>
                    @error('strengths_in_clearing_exams')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Areas for Improvement -->
                <div class="mb-3">
                    <label class="form-label">In which areas of your life or personality do you think you need improvement?</label>
                    <textarea class="form-control @error('areas_for_improvement') is-invalid @enderror" 
                              name="areas_for_improvement" rows="2">{{ old('areas_for_improvement') }}</textarea>
                    @error('areas_for_improvement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Obstacles to Success -->
                <div class="mb-3">
                    <label class="form-label">What obstacles do you foresee that might hinder you from achieving your goals?</label>
                    <textarea class="form-control @error('obstacles_to_success') is-invalid @enderror" 
                              name="obstacles_to_success" rows="2">{{ old('obstacles_to_success') }}</textarea>
                    @error('obstacles_to_success')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Current Challenges -->
                <div class="mb-3">
                    <label class="form-label">What challenges are you currently facing in this attempt?</label>
                    <textarea class="form-control @error('current_challenges') is-invalid @enderror" 
                              name="current_challenges" rows="2">{{ old('current_challenges') }}</textarea>
                    @error('current_challenges')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Overcoming Challenges Plan -->
                <div class="mb-3">
                    <label class="form-label">How do you plan to overcome the challenges mentioned above?</label>
                    <textarea class="form-control @error('overcoming_challenges_plan') is-invalid @enderror" 
                              name="overcoming_challenges_plan" rows="2">{{ old('overcoming_challenges_plan') }}</textarea>
                    @error('overcoming_challenges_plan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Strategies for Success -->
                <div class="mb-3">
                    <label class="form-label">What strategies have you developed to tackle challenges and achieve your goals?</label>
                    <textarea class="form-control @error('strategies_for_success') is-invalid @enderror" 
                              name="strategies_for_success" rows="2">{{ old('strategies_for_success') }}</textarea>
                    @error('strategies_for_success')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Major Distractions -->
                <div class="mb-3">
                    <label class="form-label">List the five major distractions in your life.</label>
                    <textarea class="form-control @error('major_distractions') is-invalid @enderror" 
                              name="major_distractions" rows="2" required>{{ old('major_distractions') }}</textarea>
                    @error('major_distractions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Distraction Overcoming Plan -->
                <div class="mb-3">
                    <label class="form-label">How do you plan to overcome these distractions?</label>
                    <textarea class="form-control @error('distraction_overcoming_plan') is-invalid @enderror" 
                              name="distraction_overcoming_plan" rows="2" required>{{ old('distraction_overcoming_plan') }}</textarea>
                    @error('distraction_overcoming_plan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Distraction Timeline -->
                <div class="mb-3">
                    <label class="form-label">Identify your distractions and set a timeline for overcoming them.</label>
                    <textarea class="form-control @error('distraction_timeline') is-invalid @enderror" 
                              name="distraction_timeline" rows="2">{{ old('distraction_timeline') }}</textarea>
                    @error('distraction_timeline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" id="submitButton" class="btn btn-primary mt-3">
                            <span id="spinner"></span>
                            <span id="submitText">Save and Continue</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
