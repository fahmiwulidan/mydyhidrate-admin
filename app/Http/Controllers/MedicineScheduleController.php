<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicineSchedule;

class MedicineScheduleController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal obat
        $schedules = MedicineSchedule::all();

        return response()->json($schedules);
    }

    public function storeByMedicine(Request $request)
    {
        // Validasi input yang wajib ada
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'time' => 'required|date_format:H:i',
            'reminder_time' => 'nullable|date_format:H:i',
        ]);

        // Buat jadwal baru
        $schedule = new MedicineSchedule();
        $schedule->medicine_id = $request->input('medicine_id');
        $schedule->time = $request->input('time');
        $schedule->reminder_time = $request->input('reminder_time');
        $schedule->save();

        return response()->json([
            'message' => 'Jadwal obat berhasil ditambahkan',
            'schedule' => $schedule
        ], 201);
    }
}
