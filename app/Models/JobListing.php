<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = [
        'position',          // sebelumnya title
        'description', 
        'company_id',      // HTML content dari editor
        'location',
        'detail_location',
        'min_experience',
        'publish_at',
        'expired_date',
    ];

    public function companyPicture()
{
     return $this->belongsTo(CompanyPicture::class, 'company_id', 'id');
}
}

