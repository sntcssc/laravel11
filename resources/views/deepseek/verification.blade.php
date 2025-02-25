@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Student Verification</div>
        <div class="card-body">
            <x-progress-bar :progress="0" />
            <h5 class="text-center pb-4">Information sheet Form for Special Focus Group (SFG) program</h5>
            
            <form method="POST" id="stepForm" action="{{ route('student.verify') }}">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="unique_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control @error('unique_id') is-invalid @enderror" 
                               name="unique_id" value="{{ old('unique_id') }}" placeholder="Enter your Student ID" required>
                        @error('unique_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Registered Email ID</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" placeholder="Enter your Email ID" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6 d-none">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" 
                               class="form-control @error('dob') is-invalid @enderror" 
                               name="dob" 
                               value="{{ old('dob', \Carbon\Carbon::now()->toDateString()) }}"
                               required>
                        @error('dob')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" id="submitButton" class="btn btn-primary mt-3">
                        <span id="spinner"></span>
                        <span id="submitText">Verify Student</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection