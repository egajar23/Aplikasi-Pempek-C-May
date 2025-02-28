<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        $month = $request->input('month', $currentDate->format('m'));
        $year = $request->input('year', $currentDate->format('Y'));

        // Format tanggal untuk query
        $formattedDate = "{$year}-{$month}";

        

        $detailPemesanan = DetailPemesanan::with('produk:name,id')
        ->leftJoin('pemesanan', 'detail_pemesanan.pemesanan_id', '=', 'pemesanan.id')
        ->selectRaw('
            detail_pemesanan.produk_id, 
            SUM(detail_pemesanan.jumlah) AS jumlah, 
            detail_pemesanan.harga_satuan, 
            SUM(detail_pemesanan.jumlah * detail_pemesanan.harga_satuan) AS total, 
            pemesanan.status, 
            SUM(pemesanan.promo_discount) AS diskon
        ')
        ->where('pemesanan.status', 'Dikonfirmasi') // Tambahkan kondisi status
        ->whereRaw("DATE_FORMAT(detail_pemesanan.created_at, '%Y-%m') = ?", [$formattedDate])
        ->groupBy('detail_pemesanan.produk_id', 'detail_pemesanan.harga_satuan', 'pemesanan.status')
        ->get();


        // Menambahkan filter untuk bulan dan tahun pada query Pemesanan
        $pemesanan = Pemesanan::where('status', 'Dikonfirmasi') // Status "Dikonfirmasi"
        ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$formattedDate]) // Filter berdasarkan tahun dan bulan
        ->get();

        return response()->json(['detail' => $detailPemesanan, 'pemesanan' => $pemesanan]);
    }

    public function downloadPdf(Request $request)
    {
        $currentDate = Carbon::now();
        $month = $request->input('month', $currentDate->format('m'));
        $year = $request->input('year', $currentDate->format('Y'));

        $formattedDate = "{$year}-{$month}";

        // Query DetailPemesanan
        $detailPemesanan = DetailPemesanan::with('produk:name,id')
            ->leftJoin('pemesanan', 'detail_pemesanan.pemesanan_id', '=', 'pemesanan.id')
            ->selectRaw('
                detail_pemesanan.produk_id, 
                SUM(detail_pemesanan.jumlah) AS jumlah, 
                detail_pemesanan.harga_satuan, 
                SUM(detail_pemesanan.jumlah * detail_pemesanan.harga_satuan) AS total, 
                pemesanan.status, 
                SUM(pemesanan.promo_discount) AS diskon
            ')
            ->where('pemesanan.status', 'Dikonfirmasi')
            ->whereRaw("DATE_FORMAT(detail_pemesanan.created_at, '%Y-%m') = ?", [$formattedDate])
            ->groupBy('detail_pemesanan.produk_id', 'detail_pemesanan.harga_satuan', 'pemesanan.status')
            ->get();

        // Query Pemesanan
        $pemesanan = Pemesanan::where('status', 'Dikonfirmasi')
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$formattedDate])
            ->get();

        $totalSebelumDiskon = $detailPemesanan->sum(function ($item) {
            return $item->total;
        });

        $totalDiskon = $pemesanan->sum(function ($disc) {
            return $disc->promo_discount;
        });
    
        // Menghitung total pendapatan
        $totalPendapatan = $totalSebelumDiskon - $totalDiskon;

        // Generate PDF
        $pdf = Pdf::loadView('admin.laporan_pdf', [
            'detailPemesanan' => $detailPemesanan,
            'totalPendapatan' => $totalPendapatan,
            'bulan' => $month,
            'tahun' => $year,
        ]);

        return $pdf->download("laporan_penjualan_{$month}_{$year}.pdf");
    }



}
