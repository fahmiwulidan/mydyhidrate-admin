<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    // Tampilkan daftar obat milik user yang login
    public function index()
    {
        $medicines = Medicine::where('user_id', auth()->id())->with('schedules')->get();
        return response()->json($medicines);
    }

    // Tampilkan detail obat
    public function show($id)
    {
        $medicine = Medicine::where('user_id', auth()->id())->with('schedules')->find($id);

        if (!$medicine) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        return response()->json($medicine);
    }

    // Simpan obat baru tanpa jadwal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dose' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time' => 'required|date_format:H:i',  // ubah jadi format jam
            'duration' => 'required|integer',
            'taken' => 'required|boolean',
            'taken_at' => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();

        $medicine = Medicine::create($validated);

        return response()->json([
            'message' => 'Obat berhasil ditambahkan.',
            'data' => $medicine
        ], 201);
    }

    // Simpan obat baru dengan jadwal
    public function storeWithSchedule(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dose' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',  // ubah validasi jadi jam
            'duration' => 'required|integer|min:1|max:365',
            'description' => 'nullable|string|max:255',
            'schedules' => 'required|array|min:1',
            'schedules.*.time' => 'required|date_format:H:i',
            'schedules.*.reminder_time' => 'nullable|date_format:H:i',
        ]);

        \DB::beginTransaction();

        try {
            $medicine = Medicine::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'dose' => $request->dose,
                'time' => $request->time,
                'duration' => $request->duration,
                'description' => $request->description,
                'taken' => false,
                'taken_at' => null,
            ]);

            foreach ($request->schedules as $schedule) {
                $medicine->schedules()->create([
                    'time' => $schedule['time'],
                    'reminder_time' => $schedule['reminder_time'] ?? null,
                ]);
            }

            \DB::commit();

            return response()->json([
                'message' => 'Obat dan jadwal berhasil ditambahkan',
                'data' => $medicine->load('schedules'),
            ], 201);

        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'message' => 'Gagal menambahkan obat dan jadwal',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Update obat
    public function update(Request $request, $id)
    {
        $medicine = Medicine::where('user_id', auth()->id())->find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'dose' => 'sometimes|required|string|max:255',
            'time' => 'sometimes|required|date_format:H:i',  // update validasi
            'duration' => 'sometimes|required|integer|min:1|max:365',
            'description' => 'nullable|string|max:255',
        ]);

        $medicine->update($request->only('name', 'dose', 'time', 'duration', 'description'));

        return response()->json([
            'message' => 'Obat berhasil diperbarui',
            'data' => $medicine
        ]);
    }

    // Hapus obat
    public function destroy($id)
    {
        $medicine = Medicine::where('user_id', auth()->id())->find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        $medicine->delete();

        return response()->json(['message' => 'Obat berhasil dihapus']);
    }

    // Toggle status taken
    public function toggleTaken($id)
    {
        $medicine = Medicine::where('user_id', auth()->id())->find($id);
        if (!$medicine) {
            return response()->json(['message' => 'Obat tidak ditemukan'], 404);
        }

        $medicine->taken = !$medicine->taken;
        $medicine->taken_at = $medicine->taken ? now() : null;
        $medicine->save();

        return response()->json([
            'message' => 'Status pengambilan obat berhasil diperbarui',
            'data' => $medicine
        ]);
    }
}
