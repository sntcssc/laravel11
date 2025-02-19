@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create Personality Detail</h2>
    <form action="{{ route('personality_details.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select">
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" class="form-control" value="{{ old('unique_id') }}">
            @error('unique_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="reason_for_civil_services" class="form-label">Reason for Civil Services</label>
            <textarea name="reason_for_civil_services" class="form-control">{{ old('reason_for_civil_services') }}</textarea>
            @error('reason_for_civil_services') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="essential_values_for_topping" class="form-label">Essential Values for Topping</label>
            <textarea name="essential_values_for_topping" class="form-control">{{ old('essential_values_for_topping') }}</textarea>
            @error('essential_values_for_topping') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="motivation_for_daily_effort" class="form-label">Motivation for Daily Effort</label>
            <textarea name="motivation_for_daily_effort" class="form-control">{{ old('motivation_for_daily_effort') }}</textarea>
            @error('motivation_for_daily_effort') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="strengths_in_clearing_exams" class="form-label">Strengths in Clearing Exams</label>
            <textarea name="strengths_in_clearing_exams" class="form-control">{{ old('strengths_in_clearing_exams') }}</textarea>
            @error('strengths_in_clearing_exams') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="areas_for_improvement" class="form-label">Areas for Improvement</label>
            <textarea name="areas_for_improvement" class="form-control">{{ old('areas_for_improvement') }}</textarea>
            @error('areas_for_improvement') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="obstacles_to_success" class="form-label">Obstacles to Success</label>
            <textarea name="obstacles_to_success" class="form-control">{{ old('obstacles_to_success') }}</textarea>
            @error('obstacles_to_success') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="current_challenges" class="form-label">Current Challenges</label>
            <textarea name="current_challenges" class="form-control">{{ old('current_challenges') }}</textarea>
            @error('current_challenges') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="overcoming_challenges_plan" class="form-label">Overcoming Challenges Plan</label>
            <textarea name="overcoming_challenges_plan" class="form-control">{{ old('overcoming_challenges_plan') }}</textarea>
            @error('overcoming_challenges_plan') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="strategies_for_success" class="form-label">Strategies for Success</label>
            <textarea name="strategies_for_success" class="form-control">{{ old('strategies_for_success') }}</textarea>
            @error('strategies_for_success') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="major_distractions" class="form-label">Major Distractions</label>
            <textarea name="major_distractions" class="form-control">{{ old('major_distractions') }}</textarea>
            @error('major_distractions') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="distraction_overcoming_plan" class="form-label">Distraction Overcoming Plan</label>
            <textarea name="distraction_overcoming_plan" class="form-control">{{ old('distraction_overcoming_plan') }}</textarea>
            @error('distraction_overcoming_plan') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="distraction_timeline" class="form-label">Distraction Timeline</label>
            <textarea name="distraction_timeline" class="form-control">{{ old('distraction_timeline') }}</textarea>
            @error('distraction_timeline') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
