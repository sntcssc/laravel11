<!-- resources/views/steps/step6.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 6: Additional Preparation</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 6]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Study Schedule</label>
                        <textarea class="form-control @error('study_schedule') is-invalid @enderror" 
                                  name="study_schedule" rows="4" required>{{ old('study_schedule') }}</textarea>
                        @error('study_schedule')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection