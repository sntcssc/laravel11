@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-5 text-center" style="max-width: 400px;">
        <h2 class="text-success mb-4">Registration Complete</h2>
        <p class="mb-4">Your registration has been successfully submitted.</p>
        <p class="text-muted">We have sent a confirmation email with your submission details.</p>

        <div class="mt-5">
            <a href="{{ route('student.register') }}" class="btn btn-primary w-100">Go to Login Page</a>
        </div>
    </div>
</div>
@endsection
