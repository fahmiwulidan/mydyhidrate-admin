<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses login manual TANPA DATABASE
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Data login hardcoded
    $adminEmail = 'admin@gmail.com';
    $adminPassword = 'admin123';

    if ($credentials['email'] === $adminEmail && $credentials['password'] === $adminPassword) {
        $request->session()->put('admin_logged_in', true);
        return redirect()->route('dashboard');
    }

    return redirect()->route('login')->with('error', 'Email atau password salah');
});

// Proses logout
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['success' => true]);
})->name('logout');

// Route dashboard HARUS di luar group middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rute yang membutuhkan autentikasi admin
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::get('/users/count', [UserController::class, 'getTotalUsers']);
    Route::get('/users/today', [UserController::class, 'getNewUsersToday']);
    Route::get('/users/active-sessions', [UserController::class, 'getActiveSessions']);
});
