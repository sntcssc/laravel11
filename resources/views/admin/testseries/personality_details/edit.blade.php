@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Personality Detail</h2>
    <form action="{{ route('personality_details.update', $personalityDetail->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select">
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $personalityDetail->student_id == $student->id ? 'selected' : '' }}>{{ $student->first_name }}</option>
                @endforeach
            </select>
            @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="unique_id" class="form-label">Unique ID</label>
            <input type="text" name="unique_id" class="form-control" value="{{ old('unique_id', $personalityDetail->unique_id) }}">
            @error('unique_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        @foreach (['reason_for_civil_services', 'essential_values_for_topping', 'motivation_for_daily_effort', 'strengths_in_clearing_exams', 'areas_for_improvement', 'obstacles_to_success', 'current_challenges', 'overcoming_challenges_plan', 'strategies_for_success', 'major_distractions', 'distraction_overcoming_plan', 'distraction_timeline'] as $field)
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                <textarea name="{{ $field }}" class="form-control">{{ old($field, $personalityDetail->$field) }}</textarea>
                @error($field) <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        @endforeach

        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
