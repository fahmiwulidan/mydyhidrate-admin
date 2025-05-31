<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterIntakeLog;
use Carbon\Carbon;


class WaterIntakeController extends Controller
{
    // Fungsi untuk menyimpan log minum air
    public function store(Request $request)
    {
        $request->validate([
            'volume_ml' => 'required|integer|min:1',
        ]);

        $log = WaterIntakeLog::create([
            'user_id' => auth()->id(),
            'volume_ml' => $request->volume_ml,
            'tanggal' => now()->toDateString(),
            'waktu' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $log
        ]);
    }

    // Fungsi total air minum hari ini tanpa persen
    public function today(Request $request)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        $total = WaterIntakeLog::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->sum('volume_ml');

        return response()->json([
            'status' => 'success',
            'data' => [
                'user_id' => $user->id,
                'tanggal' => $today,
                'total_volume_ml' => (int) $total, // <<< PERBAIKAN: Paksa casting ke integer
            ]
        ]);
    }

    // Fungsi: total air minum hari ini + persentase dari target
    public function todayWithPercentage(Request $request)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        $total = WaterIntakeLog::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->sum('volume_ml');

        $target = $user->target_air_harian ?? 2000; // default 2000 ml

        $percentage = $target > 0 ? ((float) $total / (float) $target) * 100 : 0; // <<< PERBAIKAN: Paksa casting ke float

        return response()->json([
            'status' => 'success',
            'data' => [
                'user_id' => $user->id,
                'tanggal' => $today,
                'total_volume_ml' => (int) $total, // <<< PERBAIKAN: Paksa casting ke integer
                'target_ml' => (int) $target, // <<< PERBAIKAN: Paksa casting ke integer
                'percentage' => round((float) $percentage, 2), // <<< Pastikan percentage adalah float
            ]
        ]);
    }

    // Fungsi baru: Riwayat konsumsi air (bisa difilter tanggal)
    public function history(Request $request)
    {
        $user = auth()->user();
        $date = $request->input('date');

        $query = WaterIntakeLog::where('user_id', $user->id);

        if ($date) {
            $query->whereDate('tanggal', $date);
        }

        // Tidak perlu casting di sini karena 'volume_ml' adalah kolom langsung, bukan hasil SUM()
        $logs = $query->orderBy('waktu', 'desc')->get(['volume_ml', 'tanggal', 'waktu']);

        return response()->json([
            'status' => 'success',
            'data' => $logs
        ]);
    }

    // Fungsi baru: Laporan mingguan (total air per hari)
    public function weekly()
    {
        $user = auth()->user();
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        $data = WaterIntakeLog::where('user_id', $user->id)
            ->whereBetween('tanggal', [$start, $end])
            ->selectRaw('tanggal, SUM(volume_ml) as total_ml')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // <<< PERBAIKAN: Lakukan casting untuk setiap item di koleksi
        $data->transform(function ($item) {
            $item->total_ml = (int) $item->total_ml; // Pastikan total_ml adalah integer
            return $item;
        });
        // >>>

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Fungsi baru: Laporan bulanan (total air per hari)
    public function monthly() // ATAU public function weekly()
    {
        $user = auth()->user();
        $start = Carbon::now()->startOfMonth(); // Atau startOfWeek untuk weekly()
        $end = Carbon::now()->endOfMonth();     // Atau endOfWeek untuk weekly()

        $data = \App\Models\WaterIntakeLog::where('user_id', $user->id)
            ->whereBetween('tanggal', [$start, $end])
            ->selectRaw('tanggal, SUM(volume_ml) as total_ml')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // <<< PERBAIKAN PENTING INI HARUS ADA >>>
        $data->transform(function ($item) {
            $item->total_ml = (int) $item->total_ml; // PASTIKAN CASTING INI
            return $item;
        });
        // >>>

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}