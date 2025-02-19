<!-- resources/views/steps/step2.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 2: Study Environment</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 2]) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Self Study Hours</label>
                        <input type="number" min="0" max="24" step="0.5"
                               class="form-control @error('self_study_hours') is-invalid @enderror"
                               name="self_study_hours" value="{{ old('self_study_hours') }}" required>
                        @error('self_study_hours')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Separate Study Room</label>
                        <select class="form-select @error('has_separate_study_room') is-invalid @enderror" 
                                name="has_separate_study_room" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('has_separate_study_room')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- 其他字段类似结构 -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection