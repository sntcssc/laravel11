<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProgramEnrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id', 'program_id', 'batch_id', 'section_id', 'status', 'created_by', 'updated_by'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Mutators for any custom logic (if needed)
    // For example, if you want to customize the `status` column
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ? 1 : 0;
    }

    // Accessor for status (if needed)
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }

    // use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'student_id', 'program_id', 'batch_id', 'section_id', 'status', 'created_by', 'updated_by', 'enrolled_at'
    // ];

    // // Relationship with Student
    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }

    // // Relationship with Program
    // public function program()
    // {
    //     return $this->belongsTo(Program::class);
    // }

    // // Relationship with Batch
    // public function batch()
    // {
    //     return $this->belongsTo(Batch::class);
    // }

    // // Relationship with Section
    // public function section()
    // {
    //     return $this->belongsTo(Section::class);
    // }
}
