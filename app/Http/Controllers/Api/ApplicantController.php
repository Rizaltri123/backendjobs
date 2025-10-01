<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'job_id'   => 'required|exists:jobs,id',
            'cv_file'  => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv_file')->store('public/cv');

        $applicant = new Applicant();
        $applicant->name = $request->name;
        $applicant->email = $request->email;
        $applicant->job_id = $request->job_id;
        $applicant->cv_path = $cvPath;
        $applicant->save();

        return response()->json(['message' => 'Application submitted successfully.'], 201);
    }
}
