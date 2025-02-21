<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'status'];

    // Optionally, you can define any relationships if applicable
    // For example, if you have an Enrollment model related to programs
    public function enrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // Define an accessor to get the program name
    public function getProgramNameAttribute()
    {
        return $this->name; // Just returning the name field, but you could format it if needed.
    }
}
