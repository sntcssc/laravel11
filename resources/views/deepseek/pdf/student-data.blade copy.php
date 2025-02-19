<!-- resources/views/pdf/student-data.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Student Application - {{ $student->unique_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { border-bottom: 2px solid #333; margin-bottom: 20px; padding-bottom: 10px; }
        .section { margin-bottom: 25px; break-inside: avoid; }
        .section-title { 
            background-color: #f8f9fa; 
            padding: 8px;
            font-weight: bold;
            border-left: 4px solid #007bff;
            margin-bottom: 15px;
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td, th { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .signature-box { 
            margin-top: 50px; 
            padding-top: 20px;
            border-top: 1px solid #000;
            width: 300px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    /* Add to existing styles */
    img {
        max-width: 100%;
        height: auto;
    }
    
    .photo-placeholder {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 4px;
        text-align: center;
        padding: 10px;
        margin-bottom: 15px;
    }
    .d-none{
        display: none;
    }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="color: #2c3e50; margin-bottom: 5px;">{{ config('app.name') }}</h2>
        <h3 style="color: #007bff; margin-top: 0;">Student Application Form</h3>
        <p style="margin: 0;">
            Application ID: {{ $student->unique_id }} | 
            Date: {{ now()->format('d/m/Y H:i') }}
        </p>
    </div>

    <!-- Personal Information -->
    <div class="section d-none">
        <div class="section-title">1. Personal Information</div>
        <table>
            <tr>
                <td width="25%">Full Name</td>
                <td width="75%">{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $student->dob->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Contact Information</td>
                <td>
                    {{ $student->mobile_number }}<br>
                    {{ $student->email }}
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    {{ $student->present_address }},<br>
                    {{ $student->present_district }}, {{ $student->present_state }} - {{ $student->present_pin }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Personal Information Section -->
    <div class="section">
        <div class="section-title">1. Personal Information</div>
        <table>
            <tr>
                <td rowspan="5" width="160" style="vertical-align: top; padding-right: 15px;">
                    @if($photoData)
                        <img src="{{ $photoData }}" 
                            style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ddd; border-radius: 4px;">
                    @else
                        <div style="width: 150px; height: 150px; background: #f8f9fa; border: 2px dashed #ddd;
                                display: flex; align-items: center; justify-content: center; color: #666;">
                            Photo Not Available
                        </div>
                    @endif
                </td>
                <td width="25%">Full Name</td>
                <td width="75%">{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $student->dob->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Contact Information</td>
                <td>
                    {{ $student->mobile_number }}<br>
                    {{ $student->email }}
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    {{ $student->present_address }},<br>
                    {{ $student->present_district }}, {{ $student->present_state }} - {{ $student->present_pin }}
                </td>
            </tr>
            <tr>
                <td>Student ID</td>
                <td>{{ $student->unique_id }}</td>
            </tr>
        </table>
    </div>

    <!-- Study Environment -->
    <div class="section">
        <div class="section-title">2. Study Environment</div>
        <table>
            @foreach($student->studentDetails->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- Preparation Details -->
    <div class="section">
        <div class="section-title">3. Preparation Details</div>
        <table>
            @foreach($student->preparationDetails->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- Study Sources -->
    <div class="section">
        <div class="section-title">4. Study Sources</div>
        <table>
            <thead>
                <tr>
                    <th width="50%">Subject</th>
                    <th>Source Material</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->sourcesUseds as $source)
                <tr>
                    <td>{{ $source->subject }}</td>
                    <td>{{ $source->source_material }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- CSAT Preparation -->
    <div class="section">
        <div class="section-title">5. CSAT Preparation</div>
        <table>
            @foreach($student->csatPreparations->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- Additional Preparation -->
    <div class="section">
        <div class="section-title">6. Additional Preparation</div>
        <table>
            @foreach($student->additionalPreparations->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- Personality Details -->
    <div class="section">
        <div class="section-title">7. Personality Assessment</div>
        <table>
            @foreach($student->personalityDetails->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- SFG Program Knowledge -->
    <div class="section">
        <div class="section-title">8. SFG Program Knowledge</div>
        <table>
            @foreach($student->sfgProgramKnowledges->first()->getAttributes() as $key => $value)
                @if(!in_array($key, ['id', 'student_id', 'created_at', 'updated_at']))
                <tr>
                    <td width="40%">{{ formatFieldName($key) }}</td>
                    <td>{{ formatPreviewValue($value) }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>

    <!-- Declaration -->
    <div class="section">
        <div class="section-title">Declaration</div>
        <p>
            I hereby declare that all the information provided in this application is true, 
            complete, and correct to the best of my knowledge. I understand that any willful 
            misrepresentation may lead to disqualification.
        </p>
        
        <div class="signature-box">
            <p>Date: ____________________</p>
            <p>Signature: ____________________</p>
        </div>
    </div>

    <div class="footer">
        This is a computer-generated document and does not require a physical signature.
    </div>
</body>
</html>