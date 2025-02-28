<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Show the detail of a pemesanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $pemesanan = Pemesanan::with(['user', 'promo', 'detailPemesanan.produk'])
                            ->findOrFail($id);

                            // dd($pemesanan);
        return view('admin.pemesanan.pemesanan_detail', compact('pemesanan'));
    }
}
