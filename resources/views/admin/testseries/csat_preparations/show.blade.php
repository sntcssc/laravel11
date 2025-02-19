@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>CSAT Preparation Details</h2>

    <div class="mb-3">
        <strong>Student:</strong> {{ $csatPreparation->student->name }}
    </div>
    <div class="mb-3">
        <strong>Unique ID:</strong> {{ $csatPreparation->unique_id }}
    </div>
    <div class="mb-3">
        <strong>Ever Failed CSAT:</strong> {{ $csatPreparation->isever_failed_csat ? 'Yes' : 'No' }}
    </div>
    <div class="mb-3">
        <strong>Failed CSAT Count:</strong> {{ $csatPreparation->failed_csat_count }}
    </div>
    <div class="mb-3">
        <strong>Difficult CSAT Section:</strong> {{ $csatPreparation->difficult_csat_section }}
    </div>
    <div class="mb-3">
        <strong>Took CSAT Coaching:</strong> {{ $csatPreparation->took_csat_coaching ? 'Yes' : 'No' }}
    </div>
    <div class="mb-3">
        <strong>Mock Test for CSAT:</strong> {{ $csatPreparation->mock_test_for_csat ? 'Yes' : 'No' }}
    </div>
    <div class="mb-3">
        <strong>Practicing CSAT Every Day:</strong> {{ $csatPreparation->practicing_csat_every_day ? 'Yes' : 'No' }}
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('csat_preparations.edit', $csatPreparation) }}" class="btn btn-warning">Edit</a>

        <!-- Reusable Delete Component -->
        @include('components.delete', ['route' => route('csat_preparations.destroy', $csatPreparation)])
    </div>
</div>
@endsection
