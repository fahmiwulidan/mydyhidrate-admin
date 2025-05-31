<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function summary()
    {
        try {
            $totalUsers = User::count();
            $newUsersToday = User::whereDate('created_at', Carbon::today())->count();
            $activeSessions = DB::table('sessions')
                ->where('last_activity', '>=', now()->subMinutes(30)->timestamp)
                ->count();

            return response()->json([
                'total_users' => $totalUsers,
                'new_users_today' => $newUsersToday,
                'active_sessions' => $activeSessions,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengambil data dashboard: ' . $e->getMessage()
            ], 500);
        }
    }
}
