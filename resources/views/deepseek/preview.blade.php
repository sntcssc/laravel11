<!-- resources/views/preview.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Complete Form Preview</h4>
        </div>
        
        <div class="card-body">
            <div class="alert alert-warning d-none">
                <i class="bi bi-exclamation-triangle-fill"></i> 
                Verify all information before final submission. No changes allowed after submission.
            </div>

            @foreach(range(1, 8) as $stepNumber)
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        Step {{ $stepNumber }}: {{ getStepTitle($stepNumber) }}
                    </div>
                    <div class="card-body">
                        @switch($stepNumber)
                            @case(1)
                                <!-- Personal Information -->
                                <dl class="row">
                                    <!-- Image Section -->
                                    <dt class="col-sm-6">Image</dt>
                                    <dd class="col-sm-6">
                                        @if($student->photo)
                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Profile Picture" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                        @else
                                            <p>No profile image available</p>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-6">Full Name</dt>
                                    <dd class="col-sm-6">{{ $student->first_name }} {{ $student->last_name }}</dd>

                                    <dt class="col-sm-6">Date of Birth</dt>
                                    <dd class="col-sm-6">{{ formatPreviewValue($student->dob) }}</dd>

                                    <dt class="col-sm-6">Contact Info</dt>
                                    <dd class="col-sm-6">
                                        {{ $student->mobile_number }}<br>
                                        {{ $student->email }}
                                    </dd>

                                    <dt class="col-sm-6">Address</dt>
                                    <dd class="col-sm-6">
                                        {{ $student->present_address }},<br>
                                        {{ $student->present_district }}, 
                                        {{ $student->present_state }} - 
                                        {{ $student->present_pin }}
                                    </dd>
                                </dl>

                                @break

                            @case(2)
                                <!-- Study Environment -->
                                <dl class="row">
                                    @foreach($student->studentDetails->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break

                            @case(3)
                                <!-- Preparation Details -->
                                <dl class="row">
                                    @foreach($student->preparationDetails->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break

                            @case(4)
                                <!-- Study Sources -->
                                <div class="row">
                                    @foreach($student->sourcesUseds as $source)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $source->subject }}</h5>
                                                <p class="card-text">{{ $source->source_material }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @break

                            @case(5)
                                <!-- CSAT Preparation -->
                                <dl class="row">
                                    @foreach($student->csatPreparations->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break

                            @case(6)
                                <!-- Additional Preparation -->
                                <dl class="row">
                                    @foreach($student->additionalPreparations->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break

                            @case(7)
                                <!-- Personality Details -->
                                <dl class="row">
                                    @foreach($student->personalityDetails->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break

                            @case(8)
                                <!-- SFG Program Knowledge -->
                                <dl class="row">
                                    @foreach($student->sfgProgramKnowledges->first()->getAttributes() as $key => $value)
                                        @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                                        <dt class="col-sm-6">{{ getFieldLabel($key) }}</dt>
                                        <dd class="col-sm-6">{{ formatPreviewValue($value) }}</dd>
                                        @endif
                                    @endforeach
                                </dl>
                                @break
                        @endswitch
                    </div>
                </div>
            @endforeach

            <div class="mt-4 d-flex justify-content-between">

                <div class="btn-group">
                    
                    <form action="{{ route('form.final-submit') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-success" id="submit-btn">
                            <i class="bi bi-check-circle"></i> Download as PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('terms');
    const submitBtn = document.getElementById('submit-btn');
    
    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
        if(this.checked) {
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-success');
        } else {
            submitBtn.classList.remove('btn-success');
            submitBtn.classList.add('btn-secondary');
        }
    });
});
</script>
@endpush