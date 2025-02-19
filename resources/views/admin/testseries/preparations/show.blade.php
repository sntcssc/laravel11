@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Preparation Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Student: {{ $preparation->student->name }}</h5>
                <p><strong>Unique ID:</strong> {{ $preparation->unique_id }}</p>
                <p><strong>Youtube Channels Followed:</strong> {{ $preparation->youtube_channels_followed }}</p>
                <p><strong>Coaching Name:</strong> {{ $preparation->coaching_name ?? 'N/A' }}</p>
                <p><strong>Coaching Program Details:</strong> {{ $preparation->coaching_program_details ?? 'N/A' }}</p>

                <p><strong>Experience with Stress & Anxiety:</strong> {{ $preparation->experience_stress_anxiety }}</p>
                <p><strong>Positive Takeaways from Mock Tests:</strong> {{ $preparation->positive_takeaways_from_mock_tests }}</p>
                <p><strong>Mistakes After Mock Tests:</strong> {{ $preparation->mistakes_after_mock_tests }}</p>
                <p><strong>Specific Strategy for Tests:</strong> {{ $preparation->specific_strategy_for_tests }}</p>
                <p><strong>Study Hours per Day:</strong> {{ $preparation->daily_study_hours }}</p>
                <p><strong>Study Schedule:</strong> {{ $preparation->study_schedule }}</p>

                <a href="{{ route('preparations.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
