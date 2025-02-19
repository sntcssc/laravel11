<!-- resources/views/steps/step4.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 4: Study Sources</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 4]) }}" id="sources-form">
                @csrf
                <div id="sources-container">
                    <div class="source-group mb-3">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" name="sources[0][subject]" 
                                       class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="sources[0][source_material]" 
                                       class="form-control" placeholder="Source Material" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success add-source">+</button>
                            </div>
                        </div>
                    </div>
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
                           class="form-control" placeholder="Subject" required>
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