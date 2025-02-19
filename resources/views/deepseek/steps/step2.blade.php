<!-- resources/views/steps/step2.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container-fluid">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 2: Study Environment</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 2]) }}">
                @csrf
                <div class="row g-2">
                    <!-- Self Study Hours -->
                    <div class="col-md-6">
                        <label class="form-label">How many hours do you currently spend on self-study?                        </label>
                        <input type="number" min="0" max="24" step="0.5"
                               class="form-control @error('self_study_hours') is-invalid @enderror"
                               name="self_study_hours" value="{{ old('self_study_hours') }}" required>
                        @error('self_study_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Separate Study Room -->
                    <div class="col-md-6">
                        <label class="form-label">Do you have a separate study room at home?</label>
                        <select class="form-select @error('has_separate_study_room') is-invalid @enderror" 
                                name="has_separate_study_room" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="yes" {{ old('has_separate_study_room') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('has_separate_study_room') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('has_separate_study_room')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Is in Hostel -->
                    <div class="col-md-6">
                        <label class="form-label">Are you staying in the SNTCSSC hostel?</label>
                        <select class="form-select @error('is_in_hostel') is-invalid @enderror" 
                                name="is_in_hostel" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="yes" {{ old('is_in_hostel') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('is_in_hostel') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_in_hostel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Is Residing in Kolkata -->
                    <div class="col-md-6">
                        <label class="form-label">Are you residing in Kolkata?</label>
                        <select class="form-select @error('is_residing_in_kolkata') is-invalid @enderror" 
                                name="is_residing_in_kolkata" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="yes" {{ old('is_residing_in_kolkata') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('is_residing_in_kolkata') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_residing_in_kolkata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Travel Time -->
                    <div class="col-md-6">
                        <label class="form-label">What is your travel time from your current address/location to SNTCSSC? (in minutes)</label>
                        <input type="number" min="0" step="1"
                               class="form-control @error('travel_time') is-invalid @enderror"
                               name="travel_time" value="{{ old('travel_time') }}" required>
                        @error('travel_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Prelims Mode -->
                    <div class="col-md-6">
                        <label class="form-label">Preferred mode for the Prelims Test: </label>
                        <select class="form-select @error('prelims_mode') is-invalid @enderror" 
                                name="prelims_mode" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="online" {{ old('prelims_mode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('prelims_mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                        @error('prelims_mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Prelims Mode Reason -->
                    <div class="col-md-6">
                        <label class="form-label">Reason for choosing the preferred mode of examination</label>
                        <textarea class="form-control @error('prelims_mode_reason') is-invalid @enderror"
                                  name="prelims_mode_reason" rows="2" required>{{ old('prelims_mode_reason') }}</textarea>
                        @error('prelims_mode_reason')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mentoring Mode -->
                    <div class="col-md-6">
                        <label class="form-label">Preferred mode for Personal Mentoring Sessions:</label>
                        <select class="form-select @error('mentoring_mode') is-invalid @enderror" 
                                name="mentoring_mode" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="online" {{ old('mentoring_mode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('mentoring_mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                        @error('mentoring_mode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mentoring Mode Reason -->
                    <div class="col-md-6">
                        <label class="form-label">Reason for choosing the preferred mode of Personal Mentoring Sessions</label>
                        <textarea class="form-control @error('mentoring_mode_reason') is-invalid @enderror"
                                  name="mentoring_mode_reason" rows="2" required>{{ old('mentoring_mode_reason') }}</textarea>
                        @error('mentoring_mode_reason')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Is Full-Time Preparation -->
                    <div class="col-md-6">
                        <label class="form-label">Are you preparing for UPSC full-time or along with a job?</label>
                        <select class="form-select @error('is_full_time_preparation') is-invalid @enderror" 
                                name="is_full_time_preparation" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="yes" {{ old('is_full_time_preparation') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('is_full_time_preparation') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('is_full_time_preparation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Work Schedule -->
                    <div class="col-md-6">
                        <label for="work_schedule" class="form-label">If employed, what is your current work schedule</label>
                        <select 
                            class="form-control @error('work_schedule') is-invalid @enderror" 
                            name="work_schedule" id="work_schedule" required>
                            <option value="" disabled selected>Select your work schedule</option>
                            <option value="part-time" {{ old('work_schedule') == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="full-time" {{ old('work_schedule') == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="flexible" {{ old('work_schedule') == 'flexible' ? 'selected' : '' }}>Flexible</option>
                        </select>
                        @error('work_schedule')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Daily Preparation Hours -->
                    <div class="col-md-6">
                        <label class="form-label">If employed, how many hours do you dedicate to UPSC preparation daily ?</label>
                        <input type="number" min="0" max="24" step="0.5"
                               class="form-control @error('daily_preparation_hours') is-invalid @enderror"
                               name="daily_preparation_hours" value="{{ old('daily_preparation_hours') }}" required>
                        @error('daily_preparation_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
</div>
@endsection
