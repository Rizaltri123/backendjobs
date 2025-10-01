<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyPicture extends Model
{
    use HasFactory;

    protected $table = 'company_pictures';

    protected $fillable = [
        'company_name',
        'picture_path',
    ];
}
