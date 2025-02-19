@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Student Enrollment Form</h2>
            <form id="studentForm" method="POST" action="">
                @csrf

                <!-- Step 1: Personal Information -->
                <div id="step1" class="step">
                    <h3>Step 1: Personal Information</h3>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" required>
                        <span class="text-danger" id="first_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" required>
                        <span class="text-danger" id="last_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" id="dob" required>
                        <span class="text-danger" id="dob_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control" id="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="text-danger" id="gender_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <span class="text-danger" id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" required>
                        <span class="text-danger" id="phone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control" id="address" required></textarea>
                        <span class="text-danger" id="address_error"></span>
                    </div>

                    <button type="button" class="btn btn-primary" id="nextStep1">Next Step</button>
                </div>

                <!-- Step 2: Parent Information -->
                <div id="step2" class="step" style="display:none;">
                    <h3>Step 2: Parent Information</h3>
                    <div class="form-group">
                        <label for="father_name">Father's Name</label>
                        <input type="text" name="father_name" class="form-control" id="father_name" required>
                        <span class="text-danger" id="father_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="mother_name">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" id="mother_name" required>
                        <span class="text-danger" id="mother_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="emergency_contact">Emergency Contact</label>
                        <input type="text" name="emergency_contact" class="form-control" id="emergency_contact" required>
                        <span class="text-danger" id="emergency_contact_error"></span>
                    </div>

                    <button type="button" class="btn btn-primary" id="nextStep2">Next Step</button>
                    <button type="button" class="btn btn-secondary" id="prevStep2">Previous Step</button>
                </div>

                <!-- Step 3: Course Information -->
                <div id="step3" class="step" style="display:none;">
                    <h3>Step 3: Course Information</h3>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" name="course" class="form-control" id="course" required>
                        <span class="text-danger" id="course_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="enrollment_number">Enrollment Number</label>
                        <input type="text" name="enrollment_number" class="form-control" id="enrollment_number" required>
                        <span class="text-danger" id="enrollment_number_error"></span>
                    </div>

                    <button type="button" class="btn btn-primary" id="nextStep3">Next Step</button>
                    <button type="button" class="btn btn-secondary" id="prevStep3">Previous Step</button>
                </div>

                <!-- Progress Bar -->
                <div class="progress mt-3">
                    <div class="progress-bar" id="progressBar" style="width: 33%"></div>
                </div>

                <!-- Submit Button -->
                <div id="submitButton" style="display:none;">
                    <button type="submit" class="btn btn-success">Submit Form</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let currentStep = 1;

        // Step Navigation
        document.getElementById('nextStep1').addEventListener('click', function() {
            // Validate Step 1
            if (validateStep1()) {
                showStep(2);
            }
        });

        document.getElementById('nextStep2').addEventListener('click', function() {
            // Validate Step 2
            if (validateStep2()) {
                showStep(3);
            }
        });

        document.getElementById('nextStep3').addEventListener('click', function() {
            // Validate Step 3
            if (validateStep3()) {
                showSubmitButton();
            }
        });

        document.getElementById('prevStep2').addEventListener('click', function() {
            showStep(1);
        });

        document.getElementById('prevStep3').addEventListener('click', function() {
            showStep(2);
        });

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step').forEach(step => step.style.display = 'none');
            // Show current step
            document.getElementById('step' + step).style.display = 'block';

            // Update Progress Bar
            let progress = (step - 1) * 33;
            document.getElementById('progressBar').style.width = progress + '%';

            currentStep = step;
        }

        function showSubmitButton() {
            document.getElementById('submitButton').style.display = 'block';
        }

        // Validation functions for each step
        function validateStep1() {
            let isValid = true;
            let fields = ['first_name', 'last_name', 'dob', 'gender', 'email', 'phone', 'address'];
            fields.forEach(field => {
                if (!document.getElementById(field).value) {
                    document.getElementById(field + '_error').innerText = 'This field is required';
                    isValid = false;
                } else {
                    document.getElementById(field + '_error').innerText = '';
                }
            });
            return isValid;
        }

        function validateStep2() {
            let isValid = true;
            let fields = ['father_name', 'mother_name', 'emergency_contact'];
            fields.forEach(field => {
                if (!document.getElementById(field).value) {
                    document.getElementById(field + '_error').innerText = 'This field is required';
                    isValid = false;
                } else {
                    document.getElementById(field + '_error').innerText = '';
                }
            });
            return isValid;
        }

        function validateStep3() {
            let isValid = true;
            let fields = ['course', 'enrollment_number'];
            fields.forEach(field => {
                if (!document.getElementById(field).value) {
                    document.getElementById(field + '_error').innerText = 'This field is required';
                    isValid = false;
                } else {
                    document.getElementById(field + '_error').innerText = '';
                }
            });
            return isValid;
        }
    });
</script>
@endsection
