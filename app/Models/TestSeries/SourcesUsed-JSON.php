<?php

namespace App\Models\TestSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Student;

class SourcesUsed extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'unique_id',
        'subjects_materials',
    ];

    protected $casts = [
        'subjects_materials' => 'array', // Automatically cast to an array when accessing this field
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
