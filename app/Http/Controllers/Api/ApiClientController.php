<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiClient;
use Illuminate\Support\Str;

class ApiClientController extends Controller
{
    public function index()
    {
        return ApiClient::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'whitelisted_domains' => 'nullable|array',
            'whitelisted_ips' => 'nullable|array',
        ]);

        $client = ApiClient::create([
            'name' => $request->name,
            'token' => Str::random(64),
            'whitelisted_domains' => $request->whitelisted_domains,
            'whitelisted_ips' => $request->whitelisted_ips,
            'status' => 'active',
        ]);

        return response()->json($client);
    }

    public function update(Request $request, ApiClient $apiClient)
    {
        $apiClient->update($request->only(['name', 'whitelisted_domains', 'whitelisted_ips', 'status']));
        return response()->json($apiClient);
    }

    public function destroy(ApiClient $apiClient)
    {
        $apiClient->delete();
        return response()->json(['message' => 'Deleted']);
    }
}