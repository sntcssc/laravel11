<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Student;


class StudentDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'student_id',
        'self_study_hours',
        'has_separate_study_room',
        'is_in_hostel',
        'is_residing_in_kolkata',
        'travel_time',
        'prelims_mode',
        'prelims_mode_reason',
        'mentoring_mode',
        'mentoring_mode_reason',
        'is_full_time_preparation',
        'work_schedule',
        'daily_preparation_hours',
    ];

    // Relationship with Student model (assuming you have a Student model already)
    public function student()
    {
        // return $this->belongsTo(Student::class);
        return $this->belongsTo(Student::class, 'student_id');
    }
}
