<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiClient;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ApiTokenMiddleware
{
public function handle(Request $request, Closure $next): Response
{
    try {
        $token = $request->header('X-API-TOKEN');

        if (!$token) {
            Log::warning('API Token missing from request.');
            return response()->json(['message' => 'API Token is required'], 401);
        }

        $client = \App\Models\ApiClient::where('api_token', $token)
            ->where('active', true)
            ->first();

        if (!$client) {
            Log::warning('Invalid or inactive API Token: ' . $token);
            return response()->json(['message' => 'Invalid or inactive API Token'], 403);
        }

        $request->merge(['api_client' => $client]);

        return $next($request);

    } catch (\Throwable $e) {
        Log::error('ApiTokenMiddleware error', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ], 500);
    }
}

}