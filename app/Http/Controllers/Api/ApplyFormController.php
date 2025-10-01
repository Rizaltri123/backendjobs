<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplyForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplyFormController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:job_listings,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'primary_contact' => 'required|string|max:50',
            'age' => 'required|integer',
            'education' => 'required',
            'experience' => 'required',
            'salary_expectation' => 'required',
            'cv_file' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload file
        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cv_files', 'public');
        }

        $data = $request->except('cv_file');
        $data['cv_file'] = $path;

        $apply = ApplyForm::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Application submitted successfully',
            'data' => $apply
        ]);
    }
    public function index()
    {
        $applyForms = ApplyForm::with('job:id,position')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id'              => $item->id,
                    'full_name'       => $item->full_name,
                    'position'        => $item->job ? $item->job->position : null, 
                    'full_name'         => $item->full_name,
                    'nickname'          => $item->nickname,
                    'age'               => $item->age,
                    'date_of_birth'     => $item->date_of_birth,
                    'place_of_birth'    => $item->place_of_birth,
                    'gender'            => $item->gender,
                    'country'           => $item->country,
                    'email'             => $item->email,
                    'primary_contact'   => $item->primary_contact,
                    'secondary_contact' => $item->secondary_contact,
                    'marital_status'    => $item->marital_status,
                    'current_address'   => $item->current_address,
                    'education'         => $item->education,
                    'certification'     => $item->certification,
                    'experience'        => $item->experience,
                    'references'        => $item->references,
                    'salary_expectation'=> $item->salary_expectation,
                    'cv_file'           => $item->cv_file,
                    'cv_summary'        => $item->cv_summary,
                    'created_at'        => $item->created_at,
                ];
            });

        return response()->json([
            'status' => true,
            'data'   => $applyForms
        ]);
    }

    public function show($id)
    {
        $applyForm = ApplyForm::with('job:id,position')->find($id);

        if (!$applyForm) {
            return response()->json([
                'status'  => false,
                'message' => 'Applicant not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $applyForm
        ]);
    }
}
