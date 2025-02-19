<!DOCTYPE html>
<html>
<head>
    <title>Final Student Form</title>
</head>
<body>
    <h1>Final Student Form</h1>
    <p><strong>Name:</strong> {{ $studentData->first_name }} {{ $studentData->last_name }}</p>
    <p><strong>Date of Birth:</strong> {{ $studentData->dob }}</p>
    <p><strong>Gender:</strong> {{ $studentData->gender }}</p>
    <p><strong>Email:</strong> {{ $studentData->email }}</p>
    <p><strong>Phone:</strong> {{ $studentData->phone }}</p>
    <p><strong>Address:</strong> {{ $studentData->address }}</p>
    <p><strong>Father's Name:</strong> {{ $studentData->father_name }}</p>
    <p><strong>Mother's Name:</strong> {{ $studentData->mother_name }}</p>
    <p><strong>Emergency Contact:</strong> {{ $studentData->emergency_contact }}</p>
    <p><strong>Course:</strong> {{ $studentData->course }}</p>
    <p><strong>Enrollment Number:</strong> {{ $studentData->enrollment_number }}</p>
</body>
</html>
