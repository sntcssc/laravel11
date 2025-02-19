Sure! Here's the updated code for the input fields, where I used a `$fieldMap` as a reference for the labels and input names, including handling the validation and dynamic population of the input values.

```php
<?php
$fieldMap = [
    // Personal Information
    'first_name' => 'Student First Name',
    'last_name' => 'Student Last Name',
    'dob' => 'Date of Birth',
    'father_name' => "Father's Name",
    'father_occupation' => "Father's Occupation",
    'mother_name' => "Mother's Name",
    'mother_occupation' => "Mother's Occupation",
    'gender' => 'Gender',
    'category' => 'Category',
    'mobile_number' => 'Mobile Number',
    'whatsapp_number' => 'WhatsApp Number',
    'email' => 'Email ID',
    'password' => 'Password',
    'present_state' => 'Present State',
    'present_district' => 'Present District',
    'present_address' => 'Present Address',
    'present_pin' => 'Present Pin',
    'permanent_state' => 'Permanent State',
    'permanent_district' => 'Permanent District',
    'permanent_address' => 'Permanent Address',
    'permanent_pin' => 'Permanent Pin',
    'photo' => 'Student Photo',
];
?>

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

                            @foreach($fieldMap as $field => $label)
                                @if($field !== 'photo')
                                    <div class="col-md-6">
                                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                        @if($field === 'dob')
                                            <input type="date" class="form-control @error($field) is-invalid @enderror" 
                                                   id="{{ $field }}" name="{{ $field }}" 
                                                   value="{{ old($field, $student->$field ? $student->$field->format('Y-m-d') : '') }}" required>
                                        @elseif($field === 'gender' || $field === 'category')
                                            <select class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" required>
                                                <option value="" disabled>Select {{ $label }}</option>
                                                @foreach(['male', 'female', 'other'] as $genderOption)
                                                    <option value="{{ $genderOption }}" 
                                                            {{ old($field, $student->$field ?? '') == $genderOption ? 'selected' : '' }}>
                                                        {{ ucfirst($genderOption) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" class="form-control @error($field) is-invalid @enderror" 
                                                   id="{{ $field }}" name="{{ $field }}" 
                                                   value="{{ old($field, $student->$field ?? '') }}" required>
                                        @endif
                                        @error($field)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="container">
                        <div class="row mb-4 mt-4">
                            <h5 class="col-md-12">Present Address</h5>
                            
                            @foreach(['present_state', 'present_district', 'present_address', 'present_pin'] as $field)
                                <div class="col-md-6">
                                    <label for="{{ $field }}" class="form-label">{{ $fieldMap[$field] }}</label>
                                    <input type="text" class="form-control @error($field) is-invalid @enderror" 
                                           id="{{ $field }}" name="{{ $field }}" 
                                           value="{{ old($field, $student->$field ?? '') }}" required>
                                    @error($field)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <h5 class="col-md-12">Permanent Address</h5>

                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="copy_address" onclick="copyAddress()">
                                    <label class="form-check-label" for="copy_address">Same as Present Address</label>
                                </div>
                            </div>

                            @foreach(['permanent_state', 'permanent_district', 'permanent_address', 'permanent_pin'] as $field)
                                <div class="col-md-6">
                                    <label for="{{ $field }}" class="form-label">{{ $fieldMap[$field] }}</label>
                                    <input type="text" class="form-control @error($field) is-invalid @enderror" 
                                           id="{{ $field }}" name="{{ $field }}" 
                                           value="{{ old($field, $student->$field ?? '') }}" required>
                                    @error($field)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">{{ $fieldMap['photo'] }}</label>
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

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
```

### Explanation:
- **Field Mapping**: I defined the `$fieldMap` array at the top with all the required field names as keys and their respective labels as values. This array will be used to generate the form fields dynamically.
- **Dynamic Form Generation**: Inside the form, I loop through the `$fieldMap` and generate the input fields. It uses `@foreach` to iterate through the fields.
- **Field Types**: For specific fields like date of birth (`dob`), gender, and category, I used specific input types (date and select).
- **Error Handling**: For each field, I included error handling (`@error`) to display validation messages if any error occurs.
- **Photo Upload**: This is handled separately, as it is an image file upload input.
