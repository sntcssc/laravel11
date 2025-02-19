<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;

class CsatPreparation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'unique_id',
        'isever_failed_csat',
        'failed_csat_count',
        'difficult_csat_section',
        'took_csat_coaching',
        'mock_test_for_csat',
        'practicing_csat_every_day',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
