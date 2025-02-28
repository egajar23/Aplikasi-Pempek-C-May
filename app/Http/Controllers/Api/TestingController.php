<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        $year = $request->input('year', $currentDate->format('Y'));

        $data = Pemesanan::selectRaw("
            DATE_FORMAT(created_at, '%Y-%m') AS month, 
            SUM(total_harga - ongkir) AS income
        ")
        ->where('status', 'Dikonfirmasi') // Hanya pesanan yang dikonfirmasi
        ->whereYear('created_at', $year) // Filter berdasarkan tahun
        ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
        ->get();

        return response()->json($data);
    }

}
