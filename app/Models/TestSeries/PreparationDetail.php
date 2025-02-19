<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Student;

class PreparationDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'student_id',
        'highest_education_qualification',
        'graduation_subject',
        'optional_subject',
        'start_year',
        'has_coaching',
        'coaching_institute',
        'coaching_year',
        'attempt_count',
        'cleared_prelims',
        'cleared_prelims_year',
        'cleared_mains',
        'cleared_mains_year',
        'marks_in_attempts',
        'revision_count',
        'strong_subjects',
        'challenging_subjects',
        'comfortable_prelims_subjects',
        'struggle_prelims_subjects',
        'primary_current_affairs_source',
        'current_affairs_study_hours',
        'full_prelims_reading_completed',
        'revision_before_prelims',
        'revision_time_per_day',
        'revision_method',
        'avoid_past_mistakes',
        'review_pyq_frequency',
        'upsc_pyq_analysis_completed',
        'solved_practice_questions_after_each_chapter',
        'note_preparation_for_pyqs',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
