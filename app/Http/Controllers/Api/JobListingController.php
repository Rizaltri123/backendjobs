<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
{
    $jobs = JobListing::with('companyPicture')
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'data' => $jobs
    ]);
}

public function show($id)
{
    $job = JobListing::with('companyPicture')->find($id);

    if (!$job) {
        return response()->json([
            'status' => false,
            'message' => 'Job not found'
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $job
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'position'         => 'required|string|max:255',
        'company_id'       => 'required|exists:company_pictures,id',
        'location'         => 'required|string|max:255',
        'detail_location'  => 'nullable|string',
        'min_experience'   => 'required|integer|min:0',
        'publish_at'       => 'required|date',
        'expired_date'     => 'required|date|after_or_equal:publish_at',
        'description'      => 'nullable|string',
    ]);

    // Tambahkan konversi format di sini
    $validated['publish_at'] = date('Y-m-d H:i:s', strtotime($validated['publish_at']));
    $validated['expired_date'] = date('Y-m-d H:i:s', strtotime($validated['expired_date']));

    $job = JobListing::create($validated);

    return response()->json([
        'status' => true,
        'message' => 'Job berhasil ditambahkan.',
        'data' => $job
    ]);
}


}
