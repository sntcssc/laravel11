<!-- resources/views/steps/step1.blade.php -->
@extends('deepseek.layouts.app')

@section('content')
<div class="container">
    <x-progress-bar :progress="$progress" />
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Step 1: Personal Information</div>
        <div class="card-body">
            <form method="POST" action="{{ route('form.step', ['step' => 1]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                               id="first_name" name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" required>
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                               id="last_name" name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" required>
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Father Name -->
                    <div class="col-md-6">
                        <label for="father_name" class="form-label">Father's Name</label>
                        <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                               id="father_name" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}" required>
                        @error('father_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Father Occupation -->
                    <div class="col-md-6">
                        <label for="father_occupation" class="form-label">Father's Occupation</label>
                        <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" 
                               id="father_occupation" name="father_occupation" value="{{ old('father_occupation', $student->father_occupation ?? '') }}" required>
                        @error('father_occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mother Name -->
                    <div class="col-md-6">
                        <label for="mother_name" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                               id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name ?? '') }}" required>
                        @error('mother_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mother Occupation -->
                    <div class="col-md-6">
                        <label for="mother_occupation" class="form-label">Mother's Occupation</label>
                        <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror" 
                               id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation', $student->mother_occupation ?? '') }}" required>
                        @error('mother_occupation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                               id="dob" name="dob" value="{{ old('dob', $student->dob ?? '') }}" required>
                        @error('dob')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="" disabled>Select Gender</option>
                            <option value="male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $student->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="" disabled>Select Category</option>
                            <option value="General" {{ old('category', $student->category ?? '') == 'General' ? 'selected' : '' }}>General</option>
                            <option value="OBC" {{ old('category', $student->category ?? '') == 'OBC' ? 'selected' : '' }}>OBC</option>
                            <option value="SC" {{ old('category', $student->category ?? '') == 'SC' ? 'selected' : '' }}>SC</option>
                            <option value="ST" {{ old('category', $student->category ?? '') == 'ST' ? 'selected' : '' }}>ST</option>
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mobile Number -->
                    <div class="col-md-6">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control @error('mobile_number') is-invalid @enderror" 
                               id="mobile_number" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number ?? '') }}" required>
                        @error('mobile_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="col-md-6">
                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                        <input type="tel" class="form-control @error('whatsapp_number') is-invalid @enderror" 
                               id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $student->whatsapp_number ?? '') }}" required>
                        @error('whatsapp_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" value="{{ old('password', $student->password ?? '') }}" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Present State -->
                    <div class="col-md-6">
                        <label for="present_state" class="form-label">Present State</label>
                        <input type="text" class="form-control @error('present_state') is-invalid @enderror" 
                               id="present_state" name="present_state" value="{{ old('present_state', $student->present_state ?? '') }}" required>
                        @error('present_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Present District -->
                    <div class="col-md-6">
                        <label for="present_district" class="form-label">Present District</label>
                        <input type="text" class="form-control @error('present_district') is-invalid @enderror" 
                               id="present_district" name="present_district" value="{{ old('present_district', $student->present_district ?? '') }}" required>
                        @error('present_district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Present Address -->
                    <div class="col-md-6">
                        <label for="present_address" class="form-label">Present Address</label>
                        <input type="text" class="form-control @error('present_address') is-invalid @enderror" 
                               id="present_address" name="present_address" value="{{ old('present_address', $student->present_address ?? '') }}" required>
                        @error('present_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Present Pin -->
                    <div class="col-md-6">
                        <label for="present_pin" class="form-label">Present Pin</label>
                        <input type="text" class="form-control @error('present_pin') is-invalid @enderror" 
                               id="present_pin" name="present_pin" value="{{ old('present_pin', $student->present_pin ?? '') }}" required>
                        @error('present_pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Checkbox to copy Present Address, State, District, and Pin to Permanent -->
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
                        @error('permanent_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Permanent District -->
                    <div class="col-md-6">
                        <label for="permanent_district" class="form-label">Permanent District</label>
                        <input type="text" class="form-control @error('permanent_district') is-invalid @enderror" 
                               id="permanent_district" name="permanent_district" value="{{ old('permanent_district', $student->permanent_district ?? '') }}" required>
                        @error('permanent_district')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Permanent Address -->
                    <div class="col-md-6">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <input type="text" class="form-control @error('permanent_address') is-invalid @enderror" 
                               id="permanent_address" name="permanent_address" value="{{ old('permanent_address', $student->permanent_address ?? '') }}" required>
                        @error('permanent_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Permanent Pin -->
                    <div class="col-md-6">
                        <label for="permanent_pin" class="form-label">Permanent Pin</label>
                        <input type="text" class="form-control @error('permanent_pin') is-invalid @enderror" 
                               id="permanent_pin" name="permanent_pin" value="{{ old('permanent_pin', $student->permanent_pin ?? '') }}" required>
                        @error('permanent_pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Photo -->
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*" required>
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
            // If checked, copy the values from Present to Permanent fields
            document.getElementById("permanent_state").value = document.getElementById("present_state").value;
            document.getElementById("permanent_district").value = document.getElementById("present_district").value;
            document.getElementById("permanent_address").value = document.getElementById("present_address").value;
            document.getElementById("permanent_pin").value = document.getElementById("present_pin").value;
        } else {
            // If unchecked, clear the Permanent Address, State, District, and Pin fields
            document.getElementById("permanent_state").value = '';
            document.getElementById("permanent_district").value = '';
            document.getElementById("permanent_address").value = '';
            document.getElementById("permanent_pin").value = '';
        }
    }
</script>
@endsection