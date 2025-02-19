@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Step {{ $step }} of 8</h2>
    
    <!-- Progress bar showing the current step -->
    <progress value="{{ ($step / 8) * 100 }}" max="100" class="w-100 mb-4"></progress>
    
    <!-- Form for the current step -->
    <form action="{{ route('student.step', $step) }}" method="POST">
        @csrf
        
        <!-- Dynamically include form for the current step -->
        @include("web.registration.student.forms.step$step")
        
        <!-- Submit button to go to the next step -->
        <button type="submit" class="btn btn-success mt-3 w-100">Next</button>
    </form>
</div>
@endsection
