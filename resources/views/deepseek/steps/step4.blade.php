@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 4: Sources You Are Referring To:</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 4]) }}" id="sources-form">
                <p><b>List the study materials you are using for the following subjects:</b></p>
                @csrf
                <div id="sources-container">
                    @php
                        $subjects = [
                            'Indian Polity',
                            'Economics',
                            'Geography',
                            'Environment',
                            'Art & Culture',
                            'Ancient History',
                            'Medieval History',
                            'Modern History',
                            'Science & Technology',
                            'Current Affairs'
                        ];
                    @endphp

                    @foreach($subjects as $index => $subject)
                        <div class="source-group mb-3">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <input type="text" name="sources[{{ $index }}][subject]" 
                                           class="form-control" value="{{ $subject }}" placeholder="Subject" required readonly>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="sources[{{ $index }}][source_material]" 
                                           class="form-control" placeholder="Source Material" required>
                                </div>
                                <div class="col-md-2 d-none">
                                    @if ($index == count($subjects) - 1)
                                        <button type="button" class="btn btn-success add-source">+</button>
                                    @else
                                        <button type="button" class="btn btn-danger remove-source">-</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary mt-3">Next</button>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('sources-container');
    
    document.querySelector('.add-source').addEventListener('click', function() {
        const index = document.querySelectorAll('.source-group').length;
        const template = `
        <div class="source-group mb-3">
            <div class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="sources[${index}][subject]" 
                           class="form-control"  readonly>
                </div>
                <div class="col-md-5">
                    <input type="text" name="sources[${index}][source_material]" 
                           class="form-control" placeholder="Source Material" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-source">-</button>
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', template);
    });

    container.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-source')) {
            e.target.closest('.source-group').remove();
        }
    });
});
</script>
@endsection

@endsection
