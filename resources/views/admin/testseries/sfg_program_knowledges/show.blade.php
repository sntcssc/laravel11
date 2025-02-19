@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>SFG Program Knowledge Details</h2>

    <div class="mb-3">
        <strong>Student:</strong> {{ $programKnowledge->student->name }}
    </div>

    <div class="mb-3">
        <strong>Unique ID:</strong> {{ $programKnowledge->unique_id }}
    </div>

    <div class="mb-3">
        <strong>Key Features of SFG Program:</strong>
        <p>{{ $programKnowledge->key_features_of_sfg_program }}</p>
    </div>

    <div class="mb-3">
        <strong>Ways SFG Will Help in Exam:</strong>
        <p>{{ $programKnowledge->ways_sfg_will_help_in_exam }}</p>
    </div>

    <div class="mb-3">
        <strong>Regular Analysis of Prelims Performance:</strong>
        <p>{{ $programKnowledge->regular_analysis_of_prelims_performance ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-3">
        <strong>Benefits from Prelims Analysis:</strong>
        <p>{{ $programKnowledge->benefits_from_prelims_analysis }}</p>
    </div>

    <div class="mb-3">
        <strong>Identifying Weak Areas After Tests:</strong>
        <p>{{ $programKnowledge->identifying_weak_areas_after_tests ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-3">
        <strong>Working to Eliminate Weak Areas:</strong>
        <p>{{ $programKnowledge->working_to_eliminate_weak_areas }}</p>
    </div>

    <div class="mb-3">
        <strong>Reading Test Explanations:</strong>
        <p>{{ $programKnowledge->reading_test_explanations ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-3">
        <strong>Taking Notes from Explanations:</strong>
        <p>{{ $programKnowledge->taking_notes_from_explanations ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-3">
        <strong>Regular Test Participation:</strong>
        <p>{{ $programKnowledge->regular_test_participation ? 'Yes' : 'No' }}</p>
    </div>

    <div class="mb-3">
        <strong>Test Participation Challenges:</strong>
        <p>{{ $programKnowledge->test_participation_challenges }}</p>
    </div>

    <div class="mb-3">
        <strong>Overcoming Test Challenges:</strong>
        <p>{{ $programKnowledge->overcoming_test_challenges }}</p>
    </div>

    <div class="mb-3">
        <strong>Highest Test Score:</strong> {{ $programKnowledge->highest_test_score }}
    </div>

    <div class="mb-3">
        <strong>Lowest Test Score:</strong> {{ $programKnowledge->lowest_test_score }}
    </div>

    <div class="mb-3">
        <strong>Average Test Score:</strong> {{ $programKnowledge->average_test_score }}
    </div>

    <div class="mb-3">
        <strong>Belief in Clearing Prelims This Year:</strong>
        <p>{{ $programKnowledge->belief_in_clearing_prelims_this_year ? 'Yes' : 'No' }}</p>
    </div>

    <a href="{{ route('sfg_program_knowledges.edit', $programKnowledge->id) }}" class="btn btn-warning">Edit</a>
    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ route('sfg_program_knowledges.destroy', $programKnowledge->id) }}')">Delete</button>

</div>

@include('components.delete-modal')
@endsection
