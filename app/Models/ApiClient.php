<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'domain',
        'ip_address',
        'api_token',
        'active' // Kolom baru yang sudah ditambahkan
    ];

    /**
     * Default values for attributes
     */
    protected $attributes = [
        'active' => true
    ];
}