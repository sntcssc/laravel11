<!-- resources/views/steps/step8.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 8: SFG Program Knowledge</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 8]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Highest Test Score</label>
                        <input type="number" class="form-control @error('highest_test_score') is-invalid @enderror" 
                               name="highest_test_score" required>
                        @error('highest_test_score')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Confidence Level</label>
                        <select class="form-select @error('belief_in_clearing_prelims_this_year') is-invalid @enderror" 
                                name="belief_in_clearing_prelims_this_year" required>
                            <option value="1">High Confidence</option>
                            <option value="0">Need Improvement</option>
                        </select>
                        @error('belief_in_clearing_prelims_this_year')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection