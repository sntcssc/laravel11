<!-- resources/views/steps/step3.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 3: Preparation Details</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 3]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Highest Education</label>
                        <input type="text" class="form-control @error('highest_education_qualification') is-invalid @enderror" 
                               name="highest_education_qualification" required>
                        @error('highest_education_qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Review Frequency</label>
                        <select class="form-select @error('review_pyq_frequency') is-invalid @enderror" name="review_pyq_frequency" required>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="rarely">Rarely</option>
                        </select>
                        @error('review_pyq_frequency')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection