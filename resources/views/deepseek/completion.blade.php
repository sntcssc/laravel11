@extends('deepseek.layouts.app')
@push('styles')
<style>
@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }
}

.btn-outline-primary {
  animation: blink 1.5s infinite; /* Adjust the duration for faster/slower blinking */
}

</style>
@endpush

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">Submission Status</div>
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
            <!--  -->
            @if(!session('success'))
            <div class="alert alert-info">
                <h4 class="alert-heading">{{ $message }}</h4>
                <hr>
                <p class="mb-0">
                    Student ID: {{ $student->unique_id }}<br>
                    Submitted On: {{ $student->updated_at->format('d/m/Y H:i A') }}
                </p>
            </div>

                <div class="mt-4">
                    <a href="{{ route('form.download-pdf') }}" id="downloadButton" class="btn btn-primary btn-md">
                        <i class="bi bi-download"></i> 
                        <span id="submitText">Download PDF</span>
                        <span id="spinner"></span>
                    </a>
                </div>
            @endif
            <!--  -->

            <div class="mt-4">
                <a href="https://chat.whatsapp.com/EZV5eiBLS9vFIGGotTAMID" target="_blank" class="btn btn-outline-primary bg-danger text-white">
                    Join SFG WhatsApp Group
                </a>
            </div>

            <div class="mt-4 text-muted small">
                Contact administrator for any queries: iascoaching.sntcssc@gmail.com
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const downloadButton = document.getElementById('downloadButton');
            const spinner = document.getElementById('spinner');
            const submitText = document.getElementById('submitText');

            downloadButton.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent the default link action

                // Show the spinner and change the text
                spinner.style.display = 'inline-block'; // Show spinner
                submitText.textContent = 'Processing...'; // Change text

                // Disable the button (to prevent multiple clicks)
                downloadButton.classList.add('processing');
                    // Trigger the actual PDF download
                    window.location.href = "{{ route('form.download-pdf') }}";

                // Simulate the download process (e.g., after 2 seconds)
                setTimeout(function () {

                    // After the download has been triggered, reset the button (optional)
                    // Reset button to initial state
                    spinner.style.display = 'none';
                    submitText.textContent = 'Download PDF';
                    downloadButton.classList.remove('processing');
                }, 2000); // You can adjust the delay as needed (or remove it)
            });
        });
    </script>
@endpush
@endsection