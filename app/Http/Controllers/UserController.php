<?php

namespace App\Http\Controllers;

use App\Models\User; // Model user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk enkripsi
use Illuminate\Support\Facades\Validator; // Untuk validasi data yang diterima

class UserController extends Controller
{
    // Membuat dan menyimpan data akun baru ke database (Create)
    public function addAccount(Request $request)
    {
        // Validasi data akun dari request post
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'fullname' => 'required|string',
        ]);
    
        // Respon jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Akun gagal dibuat',
                'errors' => $validator->errors()
            ], 422); 
        } else {
            // Menyimpan data akun
            $user = new User;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hashing (enkripsi) password
            $user->fullname = $request->fullname;
            $user->Save();

            // Respon jika pembuatan data akun baru berhasil
            return response()->json([
                'message' => 'Akun berhasil ditambahkan',
            ], 201);
        }
    }

    // Masuk ke dalam akun dengan autentikasi 
    public function login(Request $request)
    {
        // Validasi data akun dari request post
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Respon jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Login gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Mencari user dengan email yang sesuai 
        $user = User::where('email', $request->email)->first();

        // User tidak ditemukan
        if(!$user) {
            return response()->json([
                'message' => 'Email tidak ditemukan'
            ], 401);
        }

        // Password salah
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        // Respon jika login berhasil
        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ], 200);
    }

    // Mendapatkan informasi akun berdasarkan ID (Read)
    public function getAccountInfo($id)
    {
        // Mencari user dengan ID terkait
        $user = User::find($id);

        // Kondisi user tidak ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'Akun tidak ditemukan'
            ], 404);
        }

        // Respon jika berhasil
        return response()->json([
            'message' => 'Data akun ditemukan',
            'user' => $user
        ], 200);
    }

    // Mendapatkan informasi semua akun (Read)
    public function getAccountsInfo()
    {
        // Mengambil informasi semua user
        $users = User::all();

        // Kondisi user tidak ditemukan
        if (!$users) {
            return response()->json([
                'message' => 'Tidak ada data akun'
            ], 404);
        }

        // Respon jika berhasil
        return response()->json([
            'message' => 'Daftar akun berhasil diambil',
            'users' => $users
        ], 200);
    }

    // Merubah data pada akun berdasarkan ID (Update)
    public function editAccount(Request $request, $id)
    {
        // Validasi data akun 
        $validator = Validator::make($request->all(), [
            'email' => 'sometimes|required|string|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'fullname' => 'sometimes|required|string',
        ]);

        // Kondisi validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Gagal mengupdate akun',
                'errors' => $validator->errors()
            ], 422);
        }

        // Mencari user dengan ID terkait
        $user = User::find($id);

        // Kondisi user dengan ID terkait tidak ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'Akun tidak ditemukan'
            ], 404);
        }

        // Mengubah data dari user hanya yang diberikan pada request (opsional)
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('fullname')) {
            $user->fullname = $request->fullname;
        }

        $user->save();

        // Respon jika berhasil
        return response()->json([
            'message' => 'Akun berhasil diperbarui',
            'user' => $user
        ], 200);
    }


    // Menghapus akun berdasarkan ID (Delete)
    public function deleteAccount($id)
    {
        // Mencari user berdasarkan ID
        $user = User::find($id);

        // Kondisi user tida ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'Akun tidak ditemukan'
            ], 404);
        }

        // Menghapus data user
        $user->delete();

        // Respon jika berhasil
        return response()->json([
            'message' => 'Akun berhasil dihapus'
        ], 200);
    }
}
