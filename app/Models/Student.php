<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\TestSeries\StudentDetail;
use App\Models\TestSeries\PreparationDetail;
use App\Models\TestSeries\SourcesUsed;
use App\Models\TestSeries\CsatPreparation;
use App\Models\TestSeries\AdditionalPreparation;
use App\Models\TestSeries\PersonalityDetail;
use App\Models\TestSeries\SfgProgramKnowledge;

class Student extends Model
{
    // use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'unique_id', 'batch_id', 'program_id', 'admission_date', 'first_name', 'last_name',
    //     'father_name', 'father_occupation', 'dob', 'gender', 'category', 'mobile_number', 'whatsapp_number',
    //     'email', 'password', 'present_state', 'present_district', 'present_address', 'present_pin',
    //     'permanent_state', 'permanent_district', 'permanent_address', 'permanent_pin', 'photo', 'status',
    //     'is_update', 'login'
    // ];

    // // Relationship with Batch
    // public function batch()
    // {
    //     return $this->belongsTo(Batch::class, 'batch_id');
    // }

    // // Relationship with Program
    // public function program()
    // {
    //     return $this->belongsTo(Program::class, 'program_id');
    // }

    // // Relationship with Enrollments
    // public function enrollments()
    // {
    //     return $this->hasMany(StudentProgramEnrollment::class);
    // }


    // Prevent updates to 'unique_id'
    protected $guarded = ['unique_id'];

    use HasFactory, SoftDeletes;


    protected $fillable = [
        'first_name', 'last_name',
        'father_name', 'father_occupation', 'mother_name', 'mother_occupation', 'dob', 'gender', 'category', 'mobile_number', 
        'whatsapp_number', 'email', 'present_state', 'present_district', 
        'present_address', 'present_pin', 'permanent_state', 'permanent_district', 
        'permanent_address', 'permanent_pin', 'photo', 'image', 'current_step'
    ];

    // Relationships
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    // Define programEnrollments relationship
    public function programEnrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class, 'student_id');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'student_enrolls')
            ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(StudentProgramEnrollment::class, 'student_id');
    }

    // Accessor for full name (optional, if you want to use full name often)
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Mutator for handling photo (optional)
    public function setPhotoAttribute($value)
    {
        if (is_file($value)) {
            // Assuming your photos are saved in the public storage folder
            $this->attributes['photo'] = $value->store('photos', 'public');
        }
    }

    protected $casts = [
        'expired_at' => 'datetime',
        'dob' => 'date',
        'admission_date' => 'date',
    ];

    
    /**
     * Get all the student details associated with the student.
     */
    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class);
    }
    public function PreparationDetails()
    {
        return $this->hasMany(PreparationDetail::class);
    }
    public function SourcesUseds()
    {
        return $this->hasMany(SourcesUsed::class);
    }
    public function CsatPreparations()
    {
        return $this->hasMany(CsatPreparation::class);
    }
    public function AdditionalPreparations()
    {
        return $this->hasMany(AdditionalPreparation::class);
    }
    public function PersonalityDetails()
    {
        return $this->hasMany(PersonalityDetail::class);
    }
    public function SfgProgramKnowledges()
    {
        return $this->hasMany(SfgProgramKnowledge::class);
    }

    // Add this accessor
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/'.$this->photo) : null;
    }
}
