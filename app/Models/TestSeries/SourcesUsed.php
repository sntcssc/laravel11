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
        'subject',
        'source_material',
    ];

    // Defining the relationship with the student table
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
