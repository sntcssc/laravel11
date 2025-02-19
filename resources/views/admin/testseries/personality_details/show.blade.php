@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Personality Detail: {{ $personalityDetail->unique_id }}</h2>
    <dl>
        <dt>Student Name</dt>
        <dd>{{ $personalityDetail->student->first_name }}</dd>

        @foreach (['reason_for_civil_services', 'essential_values_for_topping', 'motivation_for_daily_effort', 'strengths_in_clearing_exams', 'areas_for_improvement', 'obstacles_to_success', 'current_challenges', 'overcoming_challenges_plan', 'strategies_for_success', 'major_distractions', 'distraction_overcoming_plan', 'distraction_timeline'] as $field)
            <dt>{{ ucwords(str_replace('_', ' ', $field)) }}</dt>
            <dd>{{ $personalityDetail->$field }}</dd>
        @endforeach
    </dl>
</div>
@endsection
