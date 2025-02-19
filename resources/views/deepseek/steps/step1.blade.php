@extends('deepseek.layouts.app')

@section('content')
<div class="container-fluid">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 1: Personal Information</div>
        <div class="card-body">
            <form method="POST" class="needs-validation" action="{{ route('form.step', ['step' => 1]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="container">
                        <div class="row mb-4">
                            <h5 class="col-md-12 mt-4">Personal Information</h5>
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                    id="first_name" name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                    id="last_name" name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Father Name -->
                            <div class="col-md-6">
                                <label for="father_name" class="form-label">Father's Name</label>
                                <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                                    id="father_name" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}" required>
                                @error('father_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Father Occupation -->
                            <div class="col-md-6">
                                <label for="father_occupation" class="form-label">Father's Occupation</label>
                                <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" 
                                    id="father_occupation" name="father_occupation" value="{{ old('father_occupation', $student->father_occupation ?? '') }}" required>
                                @error('father_occupation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mother Name -->
                            <div class="col-md-6">
                                <label for="mother_name" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                                    id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name ?? '') }}" required>
                                @error('mother_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mother Occupation -->
                            <div class="col-md-6">
                                <label for="mother_occupation" class="form-label">Mother's Occupation</label>
                                <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror" 
                                    id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation', $student->mother_occupation ?? '') }}" required>
                                @error('mother_occupation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                                    id="dob" name="dob" value="{{ old('dob', $student->dob ? $student->dob->format('Y-m-d') : '') }}" required>
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="" disabled>Select Gender</option>
                                    <option value="male" {{ old('gender', $student->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $student->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $student->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="" disabled>Select Category</option>
                                    <option value="UR" {{ old('category', $student->category ?? '') == 'UR' ? 'selected' : '' }}>General</option>
                                    <option value="OBC" {{ old('category', $student->category ?? '') == 'OBC' ? 'selected' : '' }}>OBC</option>
                                    <option value="SC" {{ old('category', $student->category ?? '') == 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="ST" {{ old('category', $student->category ?? '') == 'ST' ? 'selected' : '' }}>ST</option>
                                    <option value="EWS" {{ old('category', $student->category ?? '') == 'EWS' ? 'selected' : '' }}>EWS</option>
                                    <option value="PwBD" {{ old('category', $student->category ?? '') == 'PwBD' ? 'selected' : '' }}>PwBD</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control @error('mobile_number') is-invalid @enderror" 
                                    id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number ?? '') }}" required>
                                @error('mobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- WhatsApp Number -->
                            <div class="col-md-6">
                                <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                <input type="tel" class="form-control @error('whatsapp_number') is-invalid @enderror" 
                                    id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $student->whatsapp_number ?? '') }}" required>
                                @error('whatsapp_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                        </div>
                    </div>
                    <div class="container">

                        <!-- Present Address Section -->
                        <div class="row mb-4 mt-4">
                            <h5 class="col-md-12">Present Address</h5>
                            
                            <!-- Present State -->
                            <div class="col-md-6">
                                <label for="present_state" class="form-label">Present State</label>
                                <input type="text" class="form-control @error('present_state') is-invalid @enderror" 
                                    id="present_state" name="present_state" value="{{ old('present_state', $student->present_state ?? '') }}" required>
                                @error('present_state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Present District -->
                            <div class="col-md-6">
                                <label for="present_district" class="form-label">Present District</label>
                                <input type="text" class="form-control @error('present_district') is-invalid @enderror" 
                                    id="present_district" name="present_district" value="{{ old('present_district', $student->present_district ?? '') }}" required>
                                @error('present_district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Present Address -->
                            <div class="col-md-6">
                                <label for="present_address" class="form-label">Present Address</label>
                                <input type="text" class="form-control @error('present_address') is-invalid @enderror" 
                                    id="present_address" name="present_address" value="{{ old('present_address', $student->present_address ?? '') }}" required>
                                @error('present_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Present Pin -->
                            <div class="col-md-6">
                                <label for="present_pin" class="form-label">Present Pin</label>
                                <input type="text" class="form-control @error('present_pin') is-invalid @enderror" 
                                    id="present_pin" name="present_pin" value="{{ old('present_pin', $student->present_pin ?? '') }}" required>
                                @error('present_pin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Separator -->
                        <hr class="my-4">

                        <!-- Permanent Address Section -->
                        <div class="row">
                            <h5 class="col-md-12">Permanent Address</h5>

                                <!-- Checkbox to copy Present Address to Permanent -->
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="copy_address" onclick="copyAddress()">
                                        <label class="form-check-label" for="copy_address">Same as Present Address</label>
                                    </div>
                                </div>
                            
                            <!-- Permanent State -->
                            <div class="col-md-6">
                                <label for="permanent_state" class="form-label">Permanent State</label>
                                <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" 
                                    id="permanent_state" name="permanent_state" value="{{ old('permanent_state', $student->permanent_state ?? '') }}" required>
                                @error('permanent_state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permanent District -->
                            <div class="col-md-6">
                                <label for="permanent_district" class="form-label">Permanent District</label>
                                <input type="text" class="form-control @error('permanent_district') is-invalid @enderror" 
                                    id="permanent_district" name="permanent_district" value="{{ old('permanent_district', $student->permanent_district ?? '') }}" required>
                                @error('permanent_district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permanent Address -->
                            <div class="col-md-6">
                                <label for="permanent_address" class="form-label">Permanent Address</label>
                                <input type="text" class="form-control @error('permanent_address') is-invalid @enderror" 
                                    id="permanent_address" name="permanent_address" value="{{ old('permanent_address', $student->permanent_address ?? '') }}" required>
                                @error('permanent_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permanent Pin -->
                            <div class="col-md-6">
                                <label for="permanent_pin" class="form-label">Permanent Pin</label>
                                <input type="text" class="form-control @error('permanent_pin') is-invalid @enderror" 
                                    id="permanent_pin" name="permanent_pin" value="{{ old('permanent_pin', $student->permanent_pin ?? '') }}" required>
                                @error('permanent_pin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    
                    <!-- Photo Upload -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Student Photo</label>
                            <div class="image-upload-wrapper">
                                <div class="preview-container mb-2">
                                    @if($student->photo)
                                        <img src="{{ asset('storage/'.$student->photo) }}" 
                                             class="img-preview img-fluid rounded"
                                             style="max-height: 200px">
                                    @else
                                        <div class="no-photo text-muted">
                                            No photo uploaded
                                        </div>
                                    @endif
                                </div>
                                
                                <input type="file" 
                                       class="form-control @error('photo') is-invalid @enderror" 
                                       name="photo" 
                                       id="photoInput"
                                       accept="image/*">
                                       
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                <small class="form-text text-muted">
                                    Accepted formats: JPG, PNG, JPEG (Max 2MB)
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to copy Present Address, State, District, and Pin to Permanent Address
    function copyAddress() {
        if (document.getElementById("copy_address").checked) {
            document.getElementById("permanent_state").value = document.getElementById("present_state").value;
            document.getElementById("permanent_district").value = document.getElementById("present_district").value;
            document.getElementById("permanent_address").value = document.getElementById("present_address").value;
            document.getElementById("permanent_pin").value = document.getElementById("present_pin").value;
        } else {
            document.getElementById("permanent_state").value = '';
            document.getElementById("permanent_district").value = '';
            document.getElementById("permanent_address").value = '';
            document.getElementById("permanent_pin").value = '';
        }
    }
    
    // Validate form before submitting
    document.querySelector('form').addEventListener('submit', function(event) {
        let valid = true;
        document.querySelectorAll('input[required], select[required]').forEach(function(field) {
            if (!field.value.trim()) {
                valid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        if (!valid) {
            event.preventDefault();  // Prevent form submission if validation fails
        }
    });
</script>



@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const [file] = e.target.files;
    const preview = document.querySelector('.img-preview');
    const noPhoto = document.querySelector('.no-photo');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (!preview) {
                const img = document.createElement('img');
                img.classList.add('img-preview', 'img-fluid', 'rounded');
                img.style.maxHeight = '200px';
                img.src = e.target.result;
                document.querySelector('.preview-container').appendChild(img);
                if(noPhoto) noPhoto.style.display = 'none';
            } else {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
