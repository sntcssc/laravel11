@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">Submission Complete</div>
        <div class="card-body text-center">
            @if(session('success'))
                <div class="alert alert-success">
                    <h4 class="alert-heading">🎉 Success!</h4>
                    <p class="mb-4">{{ session('success') }}</p>
                    
                    @if(session('pdf_url'))
                        <a href="{{ session('pdf_url') }}" class="btn btn-primary">
                            <i class="bi bi-file-pdf"></i> Download PDF
                        </a>
                    @endif
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <h4 class="alert-heading">⚠️ Error!</h4>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('student.verification') }}" class="btn btn-outline-primary">
                    Start New Submission
                </a>
            </div>
        </div>
    </div>
</div>
@endsection