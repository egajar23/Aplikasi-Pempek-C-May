<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        if($request->pelangganId){

            $pelanggan = User::where('id',$request->pelangganId)->first();
        }else{
            $pelanggan = User::where('role', 'user')->get();
        }
        return response()->json($pelanggan);
    }

    // Menampilkan detail pelanggan
    public function show($id)
    {
        
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        return response()->json($pelanggan);
    }

    // Mengupdate data pelanggan
    public function update(Request $request, $id)
    {
        // dd($request->all(),$id,$request->boolean('active'));
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'postal_code' => 'string|max:10',
            'province' => 'string|max:50',
            'city' => 'string|max:50',
            'address' => 'required|string|max:255',
            'membership' => 'boolean',
            'password' => 'nullable|min:8|confirmed', // Password opsional
        ]);

        $pelanggan->update([
            'name' => $validated['name'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'postal_code' => $validated['postal_code'],
            'province' => $validated['province'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'active' => $request->boolean('active'), // Untuk boolean dari checkbox
        ]);
        // Update pelanggan
        // $pelanggan->update($validated);
        if($validated['membership']){
            $pelanggan->membership = $validated['membership'];
            $pelanggan->membership_date = now();
            $pelanggan->isCountedTransaction = 0;
            $pelanggan->save();
        }else{
            $pelanggan->membership = $validated['membership'];
            $pelanggan->membership_date = null;
            $pelanggan->save();
        }

        // Cek apakah password diisi
        if (!empty($validated['password'])) {
            // Jika diisi, hash password baru
            $pelanggan->password = Hash::make($validated['password']);
            $pelanggan->save();
        }

        return response()->json(['message' => 'Pelanggan berhasil diupdate']);
    }

    public function updateProfile(Request $request, $id)
    {
        // dd($request->all(),$id,$request->boolean('active'));
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'postal_code' => 'string|max:10',
            'province' => 'string|max:50',
            'city' => 'string|max:50',
            'address' => 'required|string|max:255',
        ]);

        $pelanggan->update($validated);

        return response()->json(['message' => 'Pelanggan berhasil diupdate']);
    }

    public function updateAddress(Request $request, $id)
    {

        // dd($request->all(),$id);
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        // Validasi input
        $validated = $request->validate([
            'no_hp' => 'required|string|max:15',
            'postal_code' => 'required|string|max:10',
            'province' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:255',
        ]);

        // Update pelanggan
        $pelanggan->update($validated);

        return response()->json(['message' => 'Pelanggan berhasil diupdate']);
    }

    public function changeImage(Request $request, $id){
        
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        // dd($request->all(), $id, $request->file('profile_picture')->getClientOriginalName());

        $validated = $request->validate([
            'profile_picture' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        $image = $request->file('profile_picture');
        $newimg = time()."-".$image->getClientOriginalName();
        $image->move(custom_public_path('profile_picture'), $newimg );
            // dd($path, $newimg);
        $pelanggan->profile_picture = $newimg;
        $pelanggan->save();

        return response()->json(['message' => 'Pelanggan berhasil diupdate']);
    }

    // Menghapus pelanggan
    public function destroy($id)
    {
        $pelanggan = User::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        $pelanggan->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus']);
    }
}
