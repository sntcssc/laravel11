@extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Step 1: Personal Details</h2>
        <form id="step1Form" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Form fields -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name</label>
                <input type="text" name="father_name" id="father_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mother_name">Mother's Name</label>
                <input type="text" name="mother_name" id="mother_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="whatsapp_number">WhatsApp Number</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="present_state">Present State</label>
                <input type="text" name="present_state" id="present_state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="present_district">Present District</label>
                <input type="text" name="present_district" id="present_district" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="present_address">Present Address</label>
                <input type="text" name="present_address" id="present_address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="present_pin">Present Pin</label>
                <input type="text" name="present_pin" id="present_pin" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="permanent_state">Permanent State</label>
                <input type="text" name="permanent_state" id="permanent_state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="permanent_district">Permanent District</label>
                <input type="text" name="permanent_district" id="permanent_district" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="permanent_address">Permanent Address</label>
                <input type="text" name="permanent_address" id="permanent_address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="permanent_pin">Permanent Pin</label>
                <input type="text" name="permanent_pin" id="permanent_pin" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="photo">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <button type="button" id="previewButton" class="btn btn-primary mt-3">Preview</button>
            <button type="submit" id="submitButton" class="btn btn-success mt-3">Save & Continue</button>
        </form>
    </div>

    <!-- Modal for Preview -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Preview Your Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="previewContent">
                    <!-- Preview content will be injected here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle preview
            $('#previewButton').click(function() {
                // Get form data
                var formData = new FormData($('#step1Form')[0]);
                
                $.ajax({
                    url: "{{ route('student.registration.previewStep1') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#previewContent').html(response.preview_html);
                            $('#previewModal').modal('show');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Handle confirmation of preview
            $('#confirmButton').click(function() {
                var formData = new FormData($('#step1Form')[0]);
                
                $.ajax({
                    url: "{{ route('student.registration.confirmStep1') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('student.step2') }}";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Prevent form submission (only for AJAX handling)
            $('#step1Form').on('submit', function(e) {
                e.preventDefault();
            });
        });
    </script>
@endsection
