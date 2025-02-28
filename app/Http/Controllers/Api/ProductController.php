<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        // Load products with their images
        $products = Product::with('images');
       
        if($request->type){
            // dd();
            $products = $products->where('type', $request->type);
        }
        
        if($request->paginate){
            $products =  $products->paginate($request->paginate);
        }else{
            $products =  $products->get();
        }

        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:55',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            // 'active' => 'boolean',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the product
        $product = Product::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'stock' => $validatedData['stock'],
            'active' => $request->boolean('active'),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->move(custom_public_path('product'), $image->getClientOriginalName());
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $image->getClientOriginalName(),
                ]);
            }
        }

        return response()->json($product->load('images'), 201);
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return response()->json($product);
    }

    public function imgDetailProduct(Request $request){
        $products = Product::with("images");
        if($request->slug){
            $product = $products->where('slug',$request->slug);
         }

         return response()->json($product->get());
    }

    public function update(Request $request, $id)
    {
        // Debugging input data dan ID
        // dd($request->all(), $id);

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'slug' => 'string|max:255',
            'description' => 'string',
            'type' => 'string|max:55',
            'price' => 'numeric|min:0',
            'weight' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update data produk
        $product->update([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'weight' => $validatedData['weight'],
            'stock' => $validatedData['stock'],
            'active' => $request->boolean('active'), // Untuk boolean dari checkbox
        ]);

        // Handle upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Simpan gambar ke folder 'product' di dalam 'public'
                $imagePath = $image->store('product', 'public');

                // Simpan informasi gambar ke database
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Kembalikan response JSON produk beserta relasi images
        return response()->json($product->load('images'));
    }


    public function destroy($id)
    {
        // Ambil produk beserta relasi images
        $product = Product::with('images')->findOrFail($id);

        // Hapus gambar terkait
        foreach ($product->images as $image) {
            // Hapus file gambar dari storage
            Storage::disk('public')->delete($image->image_path);

            // Hapus data gambar dari database
            $image->delete();
        }

        // Hapus produk
        $product->delete();

        // Kembalikan response kosong dengan status 204
        return response()->json(null, 200);
    }

}
