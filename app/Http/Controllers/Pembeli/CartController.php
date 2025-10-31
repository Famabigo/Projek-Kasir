<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('pembeli.cart', compact('cart', 'total'));
    }
    
    public function add(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        
        // Validate quantity
        $quantity = $request->input('quantity', 1);
        
        if ($barang->stok < 1) {
            return back()->with('error', 'Produk tidak tersedia');
        }
        
        if ($quantity > $barang->stok) {
            return back()->with('error', 'Stok tidak mencukupi');
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($newQuantity > $barang->stok) {
                return back()->with('error', 'Stok tidak mencukupi');
            }
            $cart[$id]['quantity'] = $newQuantity;
        } else {
            $cart[$id] = [
                'name' => $barang->nama_barang,
                'price' => $barang->harga_jual,
                'quantity' => $quantity,
                'image' => $barang->gambar,
                'ukuran' => $barang->ukuran
            ];
        }
        
        session()->put('cart', $cart);
        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }
    
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $barang = Barang::find($id);
            $quantity = $request->quantity;
            
            if ($quantity > $barang->stok) {
                return back()->with('error', 'Stok tidak mencukupi');
            }
            
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]);
            }
            
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Keranjang diperbarui');
    }
    
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Produk dihapus dari keranjang');
    }
    
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan');
    }

    public function addBulk(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:barang,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $addedCount = 0;
        $errors = [];

        foreach ($request->products as $product) {
            $barang = Barang::find($product['id']);
            
            if (!$barang) {
                $errors[] = "Produk tidak ditemukan";
                continue;
            }

            if ($barang->stok < 1) {
                $errors[] = "{$barang->nama_barang} tidak tersedia";
                continue;
            }

            $requestedQty = $product['quantity'];
            
            // Check if product already in cart
            if (isset($cart[$product['id']])) {
                $newQuantity = $cart[$product['id']]['quantity'] + $requestedQty;
                
                if ($newQuantity > $barang->stok) {
                    $errors[] = "{$barang->nama_barang} - stok tidak mencukupi";
                    continue;
                }
                
                $cart[$product['id']]['quantity'] = $newQuantity;
            } else {
                if ($requestedQty > $barang->stok) {
                    $errors[] = "{$barang->nama_barang} - stok tidak mencukupi";
                    continue;
                }
                
                $cart[$product['id']] = [
                    'name' => $barang->nama_barang,
                    'price' => $barang->harga_jual,
                    'quantity' => $requestedQty,
                    'image' => $barang->gambar
                ];
            }
            
            $addedCount++;
        }

        session()->put('cart', $cart);
        
        $cartCount = count($cart);
        
        if ($addedCount > 0 && empty($errors)) {
            return response()->json([
                'success' => true,
                'message' => "{$addedCount} produk berhasil ditambahkan ke keranjang",
                'cartCount' => $cartCount
            ]);
        } elseif ($addedCount > 0 && !empty($errors)) {
            return response()->json([
                'success' => true,
                'message' => "{$addedCount} produk ditambahkan, " . count($errors) . " gagal: " . implode(', ', $errors),
                'cartCount' => $cartCount
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk: ' . implode(', ', $errors)
            ], 400);
        }
    }
}
