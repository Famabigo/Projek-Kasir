<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        
        return view('pembeli.product-detail', compact('barang'));
    }
}
