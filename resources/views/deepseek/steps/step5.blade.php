<!-- resources/views/steps/step5.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 5: CSAT Preparation</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 5]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Have you ever failed to qualify for CSAT in Prelims?</label>
                        <select class="form-select @error('isever_failed_csat') is-invalid @enderror" name="isever_failed_csat" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('isever_failed_csat') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('isever_failed_csat') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('isever_failed_csat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">If yes, how many times?</label>
                        <input type="number" class="form-control @error('failed_csat_count') is-invalid @enderror" 
                               name="failed_csat_count" required>
                        @error('failed_csat_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Which section of the CSAT do you find most difficult?</label>
                        <input type="text" class="form-control @error('difficult_csat_section') is-invalid @enderror" 
                               name="difficult_csat_section" required>
                        @error('difficult_csat_section')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Did you take any coaching for CSAT?</label>
                        <select class="form-select @error('took_csat_coaching') is-invalid @enderror" name="took_csat_coaching" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('took_csat_coaching') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('took_csat_coaching') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('took_csat_coaching')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Did you attempt mock tests for CSAT before the Prelims?</label>
                        <select class="form-select @error('mock_test_for_csat') is-invalid @enderror" name="mock_test_for_csat" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('mock_test_for_csat') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('mock_test_for_csat') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('mock_test_for_csat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Do you practice CSAT every day?</label>
                        <select class="form-select @error('practicing_csat_every_day') is-invalid @enderror" name="practicing_csat_every_day" required>
                            <option value="">Select an option</option>
                            <option value="yes" {{ old('practicing_csat_every_day') == 'yes' ? 'selected' : '' }}>Yes</option>
                            <option value="no" {{ old('practicing_csat_every_day') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('practicing_csat_every_day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
