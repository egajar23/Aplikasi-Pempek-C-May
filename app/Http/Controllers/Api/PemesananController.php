<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Product;
use App\Models\Promo;
use App\Models\UsedPromo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua pemesanan dengan data pengguna dan promo
        $pemesanan = Pemesanan::with(['user', 'promo'])
            ->orderBy('tanggal_pemesanan', 'desc');


        // dd($request->status);
        if($request->pelanggan_id){
            $pemesanan = $pemesanan->with(['detailPemesanan', 'review'])->where('pelanggan_id', $request->pelanggan_id);
        }
        if($request->status){
            $pemesanan = $pemesanan->where('status', $request->status);
        }

        $pemesanan = $pemesanan->get();
        return response()->json($pemesanan);
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk' => 'required|string|max:255',
            'promo_code' => 'string|max:50',
            'jumlah' => 'required|integer|min:1',
            'promo_discounted' => 'numeric',
            'total_harga' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'notes' => 'string|max:255',
        ]);

        $pemesanan = Pemesanan::create($request->all());
        return response()->json($pemesanan, 201); // Mengembalikan status 201 Created
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
    }

    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'produk' => 'sometimes|string|max:255',
            'promo_code' => 'sometimes|string|max:50',
            'jumlah' => 'sometimes|integer|min:1',
            'promo_discount' => 'sometimes|numeric',
            'total_harga' => 'sometimes|numeric',
        ]);

        $pemesanan->update($request->all());
        return response()->json($pemesanan);
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $detailPemesanan = DetailPemesanan::where('pemesanan_id', $id)->get();
        
        foreach($detailPemesanan as $detail){
            $product = Product::where("id", $detail->produk_id)->first();
            $updateQuantity = $product->stock + $detail->jumlah;
            // dd($updateQuantity);
            $product->update(['stock' => $updateQuantity]);
        }
        
        $pemesanan->delete();
        return response()->json(null, 204); // Mengembalikan status 204 No Content
    }

    public function detailPemesanan($id)
    {
        
        $pemesanan = Pemesanan::with(['user', 'promo', 'detailPemesanan.produk.images'])
                            ->findOrFail($id);
        return response()->json($pemesanan);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:50',
            'type_pengiriman' => 'required',
            'ongkir' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Cari pemesanan berdasarkan ID
        $pemesanan = Pemesanan::find($id);

        if (!$pemesanan) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }

        // Update pemesanan dengan data baru
        $pemesanan->status = $request->input('status');
        $pemesanan->type_pengiriman = $request->input('type_pengiriman');
        $pemesanan->ongkir = $request->input('ongkir');
        $pemesanan->total_harga = $request->input('total_harga');
        $pemesanan->alamat = $request->alamat;

        if ($pemesanan->save()) {
            return response()->json(['message' => 'Status pesanan berhasil diperbarui'], 200);
        } else {
            return response()->json(['error' => 'Gagal memperbarui pesanan'], 500);
        }
    }

    public function paymentUpload(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Atur jenis file dan ukuran maksimal
        ]);
        
        // Simpan file ke storage
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . $file->getClientOriginalName(); 

            // Cek apakah folder 'bukti_transfer' ada, jika tidak maka buat
            $destinationPath = custom_public_path('bukti_transfer');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);

            // Update status pemesanan
            $pemesanan = Pemesanan::find($request->pemesanan_id);
            $pemesanan->status = 'Dibayar';
            $pemesanan->bukti_transfer = $filename;
            $pemesanan->save();

            return response()->json(['message' => 'Pembayaran berhasil diupload!'], 200);
        }

        throw ValidationException::withMessages(['bukti_transfer' => 'File upload tidak valid.']);
    }
    public function statusPemesanan(Request $request)
    {
        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);
        return response()->json($pemesanan);
    }

    public function konfirmasi($id)
    {
        // Cari pemesanan berdasarkan ID
        $pemesanan = Pemesanan::find($id);

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // Update status pemesanan menjadi 'Dibayar'
        $promo = PROMO::where('kode_promo', $pemesanan->promo_code)->first();      

        $pemesanan->status = 'Dikonfirmasi';
        if ($promo) {
            // Jalankan function jika promo ada
            $this->updateUsedPromo($pemesanan->pelanggan_id, $promo->id);
        }
        $userStats = $this->statsMembership($pemesanan->pelanggan_id);
        
        $pemesanan->save();

        return response()->json(['message' => 'Pemesanan berhasil dikonfirmasi', 'data' => $pemesanan]);
    }

    public function updateUsedPromo($user_id, $idPromo){
        $countUsedPromo = 0;
        $usedPromo = UsedPromo::where('pelanggan_id',$user_id)->where('promo_id',$idPromo);
      

        if($usedPromo->first()){
            $timesPromoUsed = $usedPromo->first()->times_promo_used + 1;
            // $usedPromo->times_promo_used = $timesPromoUsed +1;
            $usedPromo->update([
                'times_promo_used' => $timesPromoUsed
            ]);

        }else{
            $usedPromoData = new UsedPromo();
            $usedPromoData->pelanggan_id = $user_id;
            $usedPromoData->promo_id = $idPromo;
            $usedPromoData->times_promo_used = 1;
            $usedPromoData->save();

        }
        // dd($user_id, $idPromo,$usedPromo);
        // $findUsedPromoId = UsedPromo::findOrFail($idPromo);
        // if($usedPromo->isEmpty() && $findUsedPromoId){
        //     $countUsedPromo += 1;
        //     $usedPromo->create($user_id, $idPromo, $countUsedPromo);
        // }else if($findUsedPromoId){
        //     $countUsedPromo = $usedPromo->times_promo_used;
        //     $countUsedPromo += 1;
        //     $usedPromo->update(['times_promo_used' => $countUsedPromo]);
        // }
    }

    public function statsMembership($id){
        $user = User::where('id', $id);

        // dd($user->first()->isCountedTransaction);
        $count = $user->first()->isCountedTransaction;
        $memberStats = false;
        $userMemberStats = $user->first()->membership;

        if($count < 4 && !$userMemberStats){
            // dd($count);
            $count++;
            $user->update(['isCountedTransaction' => $count]);

        }
        else if($count >= 4 && !$userMemberStats){
            $count = 0;
            // dd($count);
            $memberStats = true;
            $user->update(['isCountedTransaction' => $count, 'membership' => $memberStats, 'membership_date' => now()]);
        }
    }

    // Fungsi untuk batal pemesanan
    public function batal($id)
    {
        // Cari pemesanan berdasarkan ID
        $pemesanan = Pemesanan::find($id);
        $detailPemesanan = DetailPemesanan::where('pemesanan_id', $id)->get();
        
        foreach($detailPemesanan as $detail){
            $product = Product::where("id", $detail->produk_id)->first();
            $updateQuantity = $product->stock + $detail->jumlah;
            // dd($updateQuantity);
            $product->update(['stock' => $updateQuantity]);
        }

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // Update status pemesanan menjadi 'Dibatalkan'
        $pemesanan->status = 'Dibatalkan';
        $pemesanan->save();

        return response()->json(['message' => 'Pemesanan berhasil dibatalkan', 'data' => $pemesanan]);
    }
    
}
