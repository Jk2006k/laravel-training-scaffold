<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Day 8: Project routes with auth middleware
    Route::resource('projects', ProjectController::class);
    
    // Nested task routes under projects
    Route::resource('projects.tasks', TaskController::class);
});

// Day 9: Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', function () {
        $users = \App\Models\User::all();
        return view('admin.users', compact('users'));
    })->name('admin.users.index');
});

require __DIR__.'/auth.php';
