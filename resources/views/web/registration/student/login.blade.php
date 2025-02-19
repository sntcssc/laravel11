@extends('admin.layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-5 w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Student Login</h2>
        
        <form action="{{ route('student.verify') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="unique_id" class="form-label">Unique ID</label>
                <input type="text" id="unique_id" name="unique_id" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="dob" class="form-label">dob</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Login</button>

            @if ($errors->any())
                <div class="mt-3 text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection


<!-- <div class="container">
    <h2>Student Verification</h2>
    <form action="{{ route('student.verify') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Student ID</label>
            <input type="text" name="unique_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div> -->

