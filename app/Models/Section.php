<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'batch_id', 'seat', 'status'];

    // Relationship with Batch
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    // You can also define a relationship to Enrollments if necessary
    public function enrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }
}
