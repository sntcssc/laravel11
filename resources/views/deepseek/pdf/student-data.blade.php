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
        <h3 style="color: #007bff; margin-top: 0;">Student Information sheet for Special Focus Group (SFG) program</h3>
        <p style="margin: 0;">
            Student ID: {{ $student->unique_id }} | 
            Date: {{ now()->format('d/m/Y h:i A') }}
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
                <td rowspan="6" width="160" style="vertical-align: top; padding-right: 15px;">
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
                <td>Student ID</td>
                <td>{{ $student->unique_id }}</td>
            </tr>
            <tr>
                <td width="25%">Name</td>
                <td width="75%">{{ $student->first_name }} {{ $student->last_name }}</td>
            </tr>
            <tr>
                <td width="25%">Enrolled</td>
                    @php
                        $program = \App\Models\Program::find($student->program_id);
                        $section = \App\Models\Section::find($student->section_id);
                        $batch = \App\Models\Batch::find($student->batch_id);
                    @endphp
                <td width="75%">
                    @if($program)
                        {{ $program->name }} | Batch: {{ $batch->name }} | Section:  {{ $section->name }}
                    @else
                        <p>Program not found.</p>
                    @endif
                </td>
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

    <!-- Study Environment -->
    <div class="section">
        <div class="section-title">2. Your Details</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->studentDetails->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- Preparation Details -->
    <div class="section">
        <div class="section-title">3. Preparation Details</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->preparationDetails->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- Study Sources -->
    <div class="section">
        <div class="section-title">4. Sources You Are Referring To:</div>
        @if($student->studentDetails->first())
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
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- CSAT Preparation -->
    <div class="section">
        <div class="section-title">5. CSAT Preparation</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->csatPreparations->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- Additional Preparation -->
    <div class="section">
        <div class="section-title">6. Additional Preparation Details:</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->additionalPreparations->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'daily_study_hours', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- Personality Details -->
    <div class="section">
        <div class="section-title">7. Your Personality</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->personalityDetails->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>

    <!-- SFG Program Knowledge -->
    <div class="section">
        <div class="section-title">8. How much you know your Special Focus Group (SFG) program?</div>
        @if($student->studentDetails->first())
            <table>
                @foreach($student->sfgProgramKnowledges->first()->getAttributes() as $key => $value)
                    @if(!in_array($key, ['id', 'student_id', 'unique_id', 'created_at', 'updated_at', 'deleted_at']))
                    <tr>
                        <td width="40%">{{ getFieldLabel($key) }}</td>
                        <td>{{ formatPreviewValue($value) }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        @else
            <p>not found.</p>
        @endif
    </div>


    <div class="footer">
        This is a computer-generated document.
    </div>
</body>
</html>