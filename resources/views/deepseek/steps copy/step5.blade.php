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
                        <label class="form-label">Ever Failed CSAT?</label>
                        <select class="form-select @error('isever_failed_csat') is-invalid @enderror" name="isever_failed_csat" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('isever_failed_csat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Difficult Section</label>
                        <input type="text" class="form-control @error('difficult_csat_section') is-invalid @enderror" 
                               name="difficult_csat_section" required>
                        @error('difficult_csat_section')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection