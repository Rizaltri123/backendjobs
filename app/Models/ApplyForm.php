<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'full_name',
        'nickname',
        'age',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'country',
        'email',
        'primary_contact',
        'secondary_contact',
        'marital_status',
        'current_address',
        'position_applied',
        'education',
        'certification',
        'experience',
        'references',
        'salary_expectation',
        'cv_file',
        'cv_summary',
    ];

    public function job()
{
    return $this->belongsTo(JobListing::class, 'job_id');
}
}
