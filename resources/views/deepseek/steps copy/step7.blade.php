<!-- resources/views/steps/step7.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 7: Personality Assessment</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 7]) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Reason for Civil Services</label>
                    <textarea class="form-control @error('reason_for_civil_services') is-invalid @enderror" 
                              name="reason_for_civil_services" rows="4" required>{{ old('reason_for_civil_services') }}</textarea>
                    @error('reason_for_civil_services')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Major Distractions</label>
                    <textarea class="form-control @error('major_distractions') is-invalid @enderror" 
                              name="major_distractions" rows="4" required>{{ old('major_distractions') }}</textarea>
                    @error('major_distractions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Next</button>
            </form>
        </div>
    </div>
</div>
@endsection