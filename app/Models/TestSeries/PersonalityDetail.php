<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;

class PersonalityDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'unique_id',
        'reason_for_civil_services',
        'essential_values_for_topping',
        'motivation_for_daily_effort',
        'strengths_in_clearing_exams',
        'areas_for_improvement',
        'obstacles_to_success',
        'current_challenges',
        'overcoming_challenges_plan',
        'strategies_for_success',
        'major_distractions',
        'distraction_overcoming_plan',
        'distraction_timeline',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
