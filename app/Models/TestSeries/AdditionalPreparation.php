<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;

class AdditionalPreparation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'unique_id',
        'youtube_channels_followed',
        'other_coaching_programs',
        'coaching_name',
        'coaching_program_details',
        'revision_before_prelims_count',
        'experience_stress_anxiety',
        'positive_takeaways_from_mock_tests',
        'mistakes_after_mock_tests',
        'specific_strategy_for_tests',
        'daily_study_hours',
        'study_schedule',
    ];

    // Define relationship with Student (One to Many)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
