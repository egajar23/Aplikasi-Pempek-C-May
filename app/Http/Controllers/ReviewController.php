<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //
    public function index(Request $request){
        // $productReview = Review::all();
        // $productReview->where('product_id', $request->product_id);
        // $productReview->with(['profile_picture'])->where('pelanggan_id', $request->user_id);
        
        // return response()->json($productReview);

        $review = Review::with('pelanggan');
        
        // dd($review->get());

        if($request->product_id){
            $review = $review->where('product_id', $request->product_id)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('bintang', 'desc');
        }

        $review = $review->get();

        return response()->json($review);
    }

    public function store(Request $request){
        // $productRevie
        // return response()->json($review, 201);

        parse_str($request->formData, $formData);
        // dd($formData);
        $data = [];
        $currentDate = Carbon::now();

        foreach ($formData['product_id'] as $i => $item) {
            $data[$i]['product_id'] = $item;
            $data[$i]['pemesanan_id'] = $request->pemesanan_id; // Ambil dari request
            $data[$i]['pelanggan_id'] = $formData['user_id'];   // Ambil user_id dari parsed formData
            $data[$i]['bintang'] = $formData['bintang'][$i];    // Ambil rating dari parsed formData
            $data[$i]['ulasan'] = $formData['ulasan'][$i];      // Ambil ulasan dari parsed formData
            $data[$i]['created_at'] = $currentDate;
            $data[$i]['updated_at'] = $currentDate;
        }

        $review = Review::insert($data);
        
        return response()->json($review);

        // dd($request->all(),);
    }
}
