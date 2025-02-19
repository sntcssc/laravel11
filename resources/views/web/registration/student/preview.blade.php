<!-- resources/views/web/registration/student/preview.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Preview Your Registration Details</h2>

        <form action="{{ route('student.final.submit') }}" method="POST">
            @csrf
            <h3>Personal Information</h3>
            <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
            <p><strong>Unique ID:</strong> {{ $student->unique_id }}</p>
            <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
            <p><strong>Mother's Name:</strong> {{ $student->mother_name }}</p>
            <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>

            <h3>Study and Preparation Details</h3>
            @if($studentDetail)
                <p><strong>Self Study Hours:</strong> {{ $studentDetail->self_study_hours }}</p>
                <p><strong>Has Separate Study Room:</strong> {{ $studentDetail->has_separate_study_room ? 'Yes' : 'No' }}</p>
            @endif

            @if($preparationDetail)
                <p><strong>Prelims Mode:</strong> {{ $preparationDetail->prelims_mode }}</p>
                <p><strong>Mentoring Mode:</strong> {{ $preparationDetail->mentoring_mode }}</p>
            @endif

            @if($sourcesUsed)
                <p><strong>Sources Used:</strong> {{ $sourcesUsed->sources_used }}</p>
            @endif

            @if($csatPreparation)
                <p><strong>CSAT Preparation:</strong> {{ $csatPreparation->csat_preparation }}</p>
            @endif

            @if($additionalPreparation)
                <p><strong>Additional Preparation:</strong> {{ $additionalPreparation->additional_preparation }}</p>
            @endif

            @if($personalityDetail)
                <p><strong>Personality Traits:</strong> {{ $personalityDetail->traits }}</p>
            @endif

            @if($sfgProgramKnowledge)
                <p><strong>Program Knowledge:</strong> {{ $sfgProgramKnowledge->program_knowledge }}</p>
            @endif

            <hr>
            <p><strong>Agreement:</strong> Please confirm that the information provided is correct and agree to the terms and conditions.</p>
            <div class="form-group">
                <label for="agree_terms">
                    <input type="checkbox" name="agree_terms" id="agree_terms" required> I agree to the terms and conditions.
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Submit Registration</button>
        </form>
    </div>
@endsection
