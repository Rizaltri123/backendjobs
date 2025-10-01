<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyPicture;
use Illuminate\Http\Request;

class CompanyPictureController extends Controller
{
    public function index()
    {
        $companies = CompanyPicture::select(['id', 'company_name', 'picture_path'])->orderBy('company_name')->get();

        return response()->json([
            'status' => true,
            'data' => $companies
        ]);
    }
}