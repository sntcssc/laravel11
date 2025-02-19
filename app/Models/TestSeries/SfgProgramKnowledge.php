<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;

class SfgProgramKnowledge extends Model
{
    protected $table = 'sfg_program_knowledges';

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'unique_id',
        'key_features_of_sfg_program',
        'ways_sfg_will_help_in_exam',
        'regular_analysis_of_prelims_performance',
        'benefits_from_prelims_analysis',
        'identifying_weak_areas_after_tests',
        'working_to_eliminate_weak_areas',
        'reading_test_explanations',
        'taking_notes_from_explanations',
        'regular_test_participation',
        'test_participation_challenges',
        'overcoming_test_challenges',
        'highest_test_score',
        'lowest_test_score',
        'average_test_score',
        'belief_in_clearing_prelims_this_year',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
