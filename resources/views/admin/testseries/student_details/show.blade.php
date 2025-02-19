@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Student Detail - {{ $studentDetail->unique_id }}</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Student Information</h5>
            <p><strong>Student Name:</strong> {{ $studentDetail->student->name }}</p>
            <p><strong>Unique ID:</strong> {{ $studentDetail->unique_id }}</p>
            <p><strong>Is in Hostel:</strong> {{ $studentDetail->is_in_hostel ? 'Yes' : 'No' }}</p>
            <p><strong>Is Residing in Kolkata:</strong> {{ $studentDetail->is_residing_in_kolkata ? 'Yes' : 'No' }}</p>
            <p><strong>Travel Time:</strong> {{ $studentDetail->travel_time }}</p>
            <p><strong>Prelims Mode:</strong> {{ $studentDetail->prelims_mode }}</p>
            <p><strong>Prelims Mode Reason:</strong> {{ $studentDetail->prelims_mode_reason }}</p>
            <p><strong>Mentoring Mode:</strong> {{ $studentDetail->mentoring_mode }}</p>
            <p><strong>Mentoring Mode Reason:</strong> {{ $studentDetail->mentoring_mode_reason }}</p>
            <p><strong>Full Time Preparation:</strong> {{ $studentDetail->is_full_time_preparation ? 'Yes' : 'No' }}</p>
            <p><strong>Work Schedule:</strong> {{ $studentDetail->work_schedule }}</p>
            <p><strong>Daily Preparation Hours:</strong> {{ $studentDetail->daily_preparation_hours }}</p>
            <p><strong>Created At:</strong> {{ $studentDetail->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Updated At:</strong> {{ $studentDetail->updated_at->format('d M Y, H:i') }}</p>
            <p><strong>Deleted At:</strong> {{ $studentDetail->deleted_at ? $studentDetail->deleted_at->format('d M Y, H:i') : 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('student_details.index') }}" class="btn btn-secondary mt-4">Back to List</a>
</div>
@endsection
