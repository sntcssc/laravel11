<h4>Personal Details</h4>
<ul class="list-unstyled">
    <li><strong>First Name:</strong> {{ $data['first_name'] }}</li>
    <li><strong>Last Name:</strong> {{ $data['last_name'] }}</li>
    <li><strong>Father's Name:</strong> {{ $data['father_name'] }}</li>
    <li><strong>Mother's Name:</strong> {{ $data['mother_name'] }}</li>
    <li><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($data['dob'])->format('d-m-Y') }}</li>
    <li><strong>Gender:</strong> {{ $data['gender'] }}</li>
    <li><strong>Category:</strong> {{ $data['category'] }}</li>
    <li><strong>Mobile Number:</strong> {{ $data['mobile_number'] }}</li>
    <li><strong>WhatsApp Number:</strong> {{ $data['whatsapp_number'] }}</li>
    <li><strong>Email:</strong> {{ $data['email'] }}</li>
    <li><strong>Password:</strong> {{ $data['password'] }}</li>
    <li><strong>Present State:</strong> {{ $data['present_state'] }}</li>
    <li><strong>Present District:</strong> {{ $data['present_district'] }}</li>
    <li><strong>Present Address:</strong> {{ $data['present_address'] }}</li>
    <li><strong>Present Pin:</strong> {{ $data['present_pin'] }}</li>
    <li><strong>Permanent State:</strong> {{ $data['permanent_state'] }}</li>
    <li><strong>Permanent District:</strong> {{ $data['permanent_district'] }}</li>
    <li><strong>Permanent Address:</strong> {{ $data['permanent_address'] }}</li>
    <li><strong>Permanent Pin:</strong> {{ $data['permanent_pin'] }}</li>
    <li><strong>Profile Photo:</strong> <img src="{{ asset('storage/' . $data['photo']) }}" alt="Profile Photo" width="100"></li>
</ul>
