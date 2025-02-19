<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'start_date', 'end_date', 'status'];

    // Optionally, you can define relationships to programs or students
    public function enrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    protected $casts = [
        'expired_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

}
