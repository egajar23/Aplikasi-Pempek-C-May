<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $cart = Cart::firstOrCreate(['pelanggan_id' => $request->pelanggan_id]);

        // Ambil produk terkait untuk memeriksa stok
        $product = Product::findOrFail($request->product_id);

        $existingItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($existingItem) {
            // Hitung jumlah total setelah penambahan
            $newQuantity = $existingItem->quantity + $request->quantity;

            // Cek apakah jumlah melebihi stok produk
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'message' => 'Stok produk sudah mencapai limit,',
                    'current_quantity' => $existingItem->quantity,
                    'stock' => $product->stock,
                ], 400); // Bad Request
            }
            // Jika item sudah ada, tambahkan kuantitas
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
            $item = $existingItem;
        } else {
            // Jika item belum ada, buat item baru
            $item = $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price
            ]);
        }

        return response()->json(['message' => 'Item added to cart', 'item' => $item]);
    }

    public function removeItem(Request $request,$id)
    {
        $cart = Cart::where('user_id', $request->id)->first();

        if ($cart) {
            $item = $cart->items()->where('id', $id)->delete();
            return response()->json(['message' => 'Item removed']);
        }

        return response()->json(['message' => 'Cart not found'], 404);
    }

    public function removeMultipleItem(Request $request)
    {

        // dd($request->all());

        $cartItem = CartItem::whereIn('id', $request->items);
        $cartItem->delete();

        return response()->json(['message' => 'item berhasil dihapus.'], 200);
    }

    public function listCart(Request $request)
    {
        $cart = Cart::with(['items.product.images'])->where('pelanggan_id', $request->id)->first();
        
        if ($cart) {
            return response()->json($cart);
        }
        
        return response()->json(['status' => 'failed', 'message' => 'Cart not found'], 200);
    }

    public function getCartCount(Request $request)
    {
        $cart = Cart::where('pelanggan_id', $request->pelanggan_id)->first();
        $count = $cart ? $cart->items()->sum('quantity') : 0;
        // dd($count);
        return response()->json(['count' => $count]);
    }

    public function updateQuantity(Request $request)
    {
        // Validate request
        $request->validate([
            'item_id' => 'required|integer',
            'action' => 'required|in:increase,decrease'
        ]);

        // Find the cart item
        $cartItem = CartItem::find($request->item_id);

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Update quantity based on action
        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } else {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            } else {
                // If quantity would become 0, remove the item
                $cartItem->delete();
                return response()->json(['message' => 'Item removed from cart']);
            }
        }

        $cartItem->save();

        // Get updated cart info
        $cart = Cart::with('items')->find($cartItem->cart_id);

        return response()->json([
            'message' => 'Quantity updated',
            'cart' => $cart
        ]);
    }
    public function applyPromo(Request $request)
    {
        // dd($request->promo);
        $promoId = $request->promo;
        // Misalnya, logika untuk mendapatkan promo
        $promo = Promo::where('id', $promoId)->first();
        // dd($promo->nama);
        if ($promo && $promo->isActive()) {
            return response()->json(['discount' => $promo->diskon, 'discount_type' => $promo->tipe_diskon, 'max_diskon' => $promo->max_diskon, 'name' => $promo->nama, 'kode_promo' => $promo->kode_promo, 'produk_id' => $promo->produk_id,'success' => true]);
        } else {
            return response()->json(['error' => 'Kode promo tidak valid atau kadaluarsa'], 400);
        }
    }

    public function checkout(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'pelanggan_id' => 'required|exists:users,id',
            'total_harga' => 'required|numeric',
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:products,id',
            'items.*.jumlah' => 'required|integer',
            'items.*.harga_satuan' => 'required|numeric',
        ]);
        
        DB::beginTransaction();

        // Buat entri pemesanan baru
        $pemesanan = Pemesanan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'promo_code' => $request->promo_code,
            'tanggal_pemesanan' => now(),
            'status' => 'pending',
            'notes' => $request->notesProduct,
            'promo_discount' => $request->promo_discount,
            'total_harga' => $request->total_harga,
        ]);

        
        $arrayItem = [];

        // Tambah detail pemesanan
        foreach ($request->items as $item) {
            DetailPemesanan::create([
                'pemesanan_id' => $pemesanan->id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
            ]);

            $product= Product::where('id', $item['produk_id'])->first();
            // dd($product);
            if($product->stock < $item['jumlah']){
                array_push($arrayItem, 0);
            }
            else{
                array_push($arrayItem, 1);
            }
            $quantity = $product->stock - $item['jumlah'];
            // dd($product->stock, $quantity);
            $product->update(['stock' => $quantity]);


            CartItem::where('id', $item['cart_item_id'])
            ->delete();
        }

        
        if(in_array(0, $arrayItem)){
            // dd($arrayItem);
            DB::rollBack();
            return response()->json(['message'=> 'Stok produk tidak mencukupi.', 'is_stock_product_avail' => false]);
        }

        DB::commit();

        return response()->json(['message' => 'Checkout berhasil', 'pemesanan_id' => $pemesanan->id , 'is_stock_product_avail' => true], 200);
    }

}
