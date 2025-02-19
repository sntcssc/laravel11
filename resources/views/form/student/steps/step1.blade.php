@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Step 1: Student Personal Details</h2>

    <form id="step1-form" method="POST" action="{{ route('student.step1-preview') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="father_name" class="form-label">Father's Name</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="father_occupation" class="form-label">Father's Occupation</label>
                    <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="{{ old('father_occupation') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mother_name" class="form-label">Mother's Name</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mother_occupation" class="form-label">Mother's Occupation</label>
                    <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="present_state" class="form-label">Present State</label>
                    <input type="text" class="form-control" id="present_state" name="present_state" value="{{ old('present_state') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="present_district" class="form-label">Present District</label>
                    <input type="text" class="form-control" id="present_district" name="present_district" value="{{ old('present_district') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="present_address" class="form-label">Present Address</label>
                    <textarea class="form-control" id="present_address" name="present_address" rows="3" required>{{ old('present_address') }}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="present_pin" class="form-label">Present PIN</label>
                    <input type="text" class="form-control" id="present_pin" name="present_pin" value="{{ old('present_pin') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="permanent_state" class="form-label">Permanent State</label>
                    <input type="text" class="form-control" id="permanent_state" name="permanent_state" value="{{ old('permanent_state') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="permanent_district" class="form-label">Permanent District</label>
                    <input type="text" class="form-control" id="permanent_district" name="permanent_district" value="{{ old('permanent_district') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="permanent_address" class="form-label">Permanent Address</label>
                    <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3" required>{{ old('permanent_address') }}</textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="permanent_pin" class="form-label">Permanent PIN</label>
                    <input type="text" class="form-control" id="permanent_pin" name="permanent_pin" value="{{ old('permanent_pin') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                </div>
            </div>

        </div>

        <!-- Preview Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Preview</button>
        </div>
    </form>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Your Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="preview-body">
                    <!-- Preview content will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="confirm-btn" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Handle form submission for Step 1 - Preview
        $('#step1-form').on('submit', function(event) {
            event.preventDefault();

            // Collect form data
            var formData = new FormData(this);
            
            // Show the preview modal
            $('#previewModal').modal('show');

            // Send the form data via AJAX to the preview route
            $.ajax({
                url: '{{ route('student.step1-preview') }}', // Your preview route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Inject preview content into the modal
                        $('#preview-body').html(response.preview_html);

                        // Handle confirmation
                        $('#confirm-btn').on('click', function() {
                            // Confirm button clicked, store the data in the session and proceed
                            $.ajax({
                                url: '{{ route('student.step1-confirm') }}', // Your confirmation route
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(confirmResponse) {
                                    if (confirmResponse.success) {
                                        // Proceed to the next step (e.g., Student Details Form)
                                        window.location.href = ''; // Redirect to step 2
                                    } else {
                                        alert('Error saving your data. Please try again.');
                                    }
                                },
                                error: function() {
                                    alert('An error occurred while saving your data.');
                                }
                            });
                        });

                    } else {
                        alert('Error generating preview.');
                    }
                },
                error: function() {
                    alert('An error occurred while loading the preview.');
                }
            });
        });

    });
</script>
@endsection
