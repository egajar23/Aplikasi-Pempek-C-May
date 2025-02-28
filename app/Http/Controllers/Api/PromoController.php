<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promo;
use App\Models\UsedPromo;
use App\Models\User;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        // $usedPromo = UsedPromo::where('pelanggan_id', $request->id)->get();
        if (!$request->has('membership')) {
            // $promo = Promo::all();
            // $product = Product::where('id', $promo->product_id);
            

            $promo = Promo::leftJoin('products', 'promo.produk_id', '=', 'products.id')
                ->select('promo.*', 'products.name')->get();

        }else{
            if($request->membership == 1){
                // $usedPromo = UsedPromo::where('pelanggan_id', $request->id);
                // $usedPromo->where('times_promo_used','>=',3);
                
                // $usedPromo= $usedPromo->pluck('promo_id')->toArray();
                
                // $promo = Promo::whereNotIn('id',$usedPromo)->get();
                // dd($promo);

                $usedPromo = UsedPromo::where('pelanggan_id', $request->id)
                    ->whereHas('promo', function ($query) {
                        $query->where(function ($q) {
                            $q->where('tipe_promo', 'MEMBER')
                                ->where('used_promos.times_promo_used', '>=', 3);
                        })->orWhere(function ($q) {
                            $q->where('tipe_promo', 'UMUM')
                                ->where('used_promos.times_promo_used', '>=', 1);
                        });
                    })
                    ->pluck('promo_id')
                    ->toArray();

                $promo = Promo::leftJoin('products', 'promo.produk_id', '=', 'products.id')
                    ->select('promo.*', 'products.name')
                    ->whereNotIn('promo.id', $usedPromo)
                    ->get();
            }
            else{
                // dd($request->all());
                // $usedPromo = UsedPromo::where('pelanggan_id', $request->id)
                //     ->whereHas('promo', function ($query) {
                //         $query->where(function ($q) {
                //             $q->where('tipe_promo', 'UMUM')
                //             ->where('used_promos.times_promo_used', '>=', 1);
                //     });
                // })->pluck('promo_id')->toArray();
                // $usedPromo = UsedPromo::where('pelanggan_id', $request->id);
                // $usedPromo->where('times_promo_used','>=',1);
                
                
                // $usedPromo= $usedPromo->pluck('promo_id')->toArray();

                // $promo = promo::where('tipe_promo', 'UMUM')->whereNotIn('id',$usedPromo)->get();
                // $promo = $promo->whereNotIn('id',$usedPromo)->get();
                // dd($promo->all());

                $usedPromo = UsedPromo::where('pelanggan_id', $request->id)
                    ->where('times_promo_used', '>=', 1)
                    ->pluck('promo_id')
                    ->toArray();

                $promo = Promo::leftJoin('products', 'promo.produk_id', '=', 'products.id')
                    ->select('promo.*', 'products.name')
                    ->where('promo.tipe_promo', 'UMUM')
                    ->whereNotIn('promo.id', $usedPromo)
                    ->get();
            }
        }
            
        return response()->json($promo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:25',
            'tipe_diskon' => 'required|string|max:55',
            'deskripsi' => 'nullable|string',
            'tipe_promo' => 'required|string|max:25',
            'produk_id' => 'nullable|int',
            'max_diskon' => 'required|numeric',
            'diskon' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'banner_promo' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner_promo')) {
            $image = $request->file('banner_promo');
            $newimg = time()."-".$image->getClientOriginalName();
            $image->move(custom_public_path('banner_promo'), $newimg);
            $validated['banner_promo'] = $newimg;
        }

        $promo = Promo::create($validated);

        return response()->json(['message' => 'Promo berhasil ditambahkan', 'promo' => $promo]);
    }

    public function show($id)
    {
        $promo = Promo::leftJoin('products', 'promo.produk_id', '=', 'products.id')
              ->select('promo.*', 'products.name')
              ->where('promo.id', $id)
              ->first();

        if (!$promo) {
            return response()->json(['message' => 'Promo tidak ditemukan'], 404);
        }

        return response()->json($promo);
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json(['message' => 'Promo tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:25',
            'tipe_diskon' => 'required|string|max:55',
            'deskripsi' => 'nullable|string',
            'tipe_promo' => 'required|string|max:25',
            'produk_id' => 'nullable|int',
            'max_diskon' => 'required|numeric',
            'diskon' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'banner_promo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('banner_promo')) {
            $image = $request->file('banner_promo');
            $newimg = time()."-".$image->getClientOriginalName();
            $image->move(custom_public_path('banner_promo'), $newimg);
            $validated['banner_promo'] = $newimg;
        }

        $promo->update($validated);
        
        return response()->json(['message' => 'Promo berhasil diupdate']);
    }

    public function destroy($id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json(['message' => 'Promo tidak ditemukan'], 404);
        }

        $promo->delete();

        return response()->json(['message' => 'Promo berhasil dihapus']);
    }
}
