<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaterIntakeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api" middleware group.
|
*/

// Public routes (no auth)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {

    // User profile routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Water intake routes
    Route::post('/water-intake', [WaterIntakeController::class, 'store']);
    Route::get('/water-intake/today', [WaterIntakeController::class, 'today']);
    Route::get('/water-intake/today-percentage', [WaterIntakeController::class, 'todayWithPercentage']);
    Route::get('/water-intake/history', [WaterIntakeController::class, 'history']);
    Route::get('/water-intake/weekly', [WaterIntakeController::class, 'weekly']);
    Route::get('/water-intake/monthly', [WaterIntakeController::class, 'monthly']);
    
    // User water target
    Route::get('/users/target-air', [UserController::class, 'getWaterTarget']);

    // Medicine routes
    Route::get('/medicines', [MedicineController::class, 'index']);
    Route::post('/medicines', [MedicineController::class, 'store']);
    Route::post('/medicines/schedule', [MedicineController::class, 'storeWithSchedule']);
    Route::get('/medicines/{id}', [MedicineController::class, 'show']);
    Route::put('/medicines/{id}', [MedicineController::class, 'update']);
    Route::delete('/medicines/{id}', [MedicineController::class, 'destroy']);
    Route::patch('/medicines/{id}/toggle-taken', [MedicineController::class, 'toggleTaken']);
    
    // Medicine schedule routes
    Route::get('/schedules', [MedicineScheduleController::class, 'index']);
    Route::post('/schedules', [MedicineScheduleController::class, 'storeByMedicine']); // pastikan ini sesuai dengan method di controller
    Route::get('/schedules/medicine/{medicine_id}', [MedicineScheduleController::class, 'showByMedicine']);
    Route::put('/schedules/{id}', [MedicineScheduleController::class, 'update']);
    Route::delete('/schedules/{id}', [MedicineScheduleController::class, 'destroy']);

    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard/summary', [DashboardController::class, 'summary']);
        Route::get('/users/count', [UserController::class, 'getTotalUsers']);
        Route::get('/users/new-today', [UserController::class, 'getNewUsersToday']);
        Route::get('/sessions/active', [UserController::class, 'getActiveSessions']);
    });
});
