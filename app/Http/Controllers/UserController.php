<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{

    public function profile(Request $request)
    {
        // Jika pakai Sanctum atau Passport, bisa pakai $request->user()
        $user = $request->user();

        // Jika ingin ambil user berdasarkan ID, bisa juga:
        // $user = User::find($request->user()->id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    
    public function index(Request $request)
    {
        try {
            $users = User::all();
            \Log::info('Users retrieved: ' . json_encode($users));
            if ($users->isEmpty()) {
                \Log::warning('No users found in the database.');
            }
            return view('user', ['users' => $users]);
        } catch (\Exception $e) {
            \Log::error('Error retrieving users: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal mengambil data user: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Gagal mengambil data user');
        }
    }

    public function getWaterTarget(Request $request)
    {
        $user = $request->user();

        // Hitung target air jika belum ada
        $targetAir = $user->target_air_harian_ml;
        if (!$targetAir || $targetAir == 0) {
            // Contoh rumus: berat badan x 35 ml
            $targetAir = $user->berat_badan ? $user->berat_badan * 35 : 0;
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'berat_badan' => $user->berat_badan,
                'target_air_harian_ml' => $targetAir,
            ]
        ]);
    }

public function updateProfile(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $validator = \Validator::make($request->all(), [
        'name' => 'sometimes|string|max:255',
        'username' => 'sometimes|string|unique:users,username,' . $user->id,
        'email' => 'sometimes|email|unique:users,email,' . $user->id,
        'berat_badan' => 'nullable|numeric|min:0',
        'tinggi_badan' => 'nullable|numeric|min:0',
        // tambahkan validasi lain jika perlu
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first()
        ], 400);
    }

    $user->update($request->only('name', 'username', 'email', 'berat_badan', 'tinggi_badan'));

    return response()->json([
        'status' => 'success',
        'data' => $user
    ]);
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'berat_badan' => 'nullable|numeric|min:0',
            'tinggi_badan' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
            ]);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan user: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|unique:users,username,' . $id,
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'berat_badan' => 'nullable|numeric|min:0',
            'tinggi_badan' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            $data = $request->only('name', 'username', 'email', 'berat_badan', 'tinggi_badan');
            if ($request->has('password') && $request->password) {
                if (\Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Password baru tidak boleh sama dengan password lama!'
                    ], 400);
                }
                $data['password'] = \Hash::make($request->password);
            }
            $user->update($data);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        try {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus user: ' . $e->getMessage()], 500);
        }
    }

    public function getTotalUsers()
    {
        $count = User::count();
        return response()->json(['count' => $count]);
    }

    public function getNewUsersToday()
    {
        try {
            $count = User::whereDate('created_at', Carbon::today())->count();
            return response()->json(['count' => $count], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data pengguna baru: ' . $e->getMessage()], 500);
        }
    }

    public function getActiveSessions()
    {
        try {
            $count = DB::table('sessions')
                ->where('last_activity', '>=', now()->subMinutes(30)->timestamp)
                ->count();
            return response()->json(['count' => $count], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil data sesi aktif: ' . $e->getMessage()], 500);
        }
    }
}
