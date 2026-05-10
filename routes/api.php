<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Laravel Training Scaffold
|--------------------------------------------------------------------------
*/

// TODO Day 10: install Sanctum and build out the API
//
// Setup steps:
//   1. composer require laravel/sanctum
//   2. php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
//   3. php artisan migrate (creates personal_access_tokens table)
//   4. Add HasApiTokens trait to app/Models/User.php
//
// Endpoints to build:
//   POST   /api/login                   → return Sanctum token
//   POST   /api/logout                  → revoke token (auth:sanctum)
//   GET    /api/projects                → list logged-in user's projects (auth:sanctum)
//   POST   /api/projects                → create
//   GET    /api/projects/{project}      → show
//   PUT    /api/projects/{project}      → update
//   DELETE /api/projects/{project}      → destroy
//   Same set under /api/tasks
//
// All responses must use API Resources (php artisan make:resource ProjectResource)

// Day 10: Public authentication routes
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    if (!auth()->attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = auth()->user();
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ],
        'token' => $token,
    ]);
})->name('api.login');

// Day 10: Protected API routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    // Logout endpoint
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    })->name('api.logout');

    // Projects API endpoints
    Route::apiResource('projects', ProjectController::class);

    // Nested tasks API endpoints under projects
    Route::apiResource('projects.tasks', TaskController::class);

    // User endpoint
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    })->name('api.user');
});