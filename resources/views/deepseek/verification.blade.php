@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Student Verification</div>
        <div class="card-body">
            <x-progress-bar :progress="0" />
            <x-errors.alert />
            
            <form method="POST" action="{{ route('student.verify') }}">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="unique_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control @error('unique_id') is-invalid @enderror" 
                               name="unique_id" value="{{ old('unique_id') }}" required>
                        @error('unique_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" 
                               class="form-control @error('dob') is-invalid @enderror" 
                               name="dob" 
                               value="{{ old('dob') }}"
                               required>
                        @error('dob')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Verify Student</button>
            </form>
        </div>
    </div>
</div>
@endsection