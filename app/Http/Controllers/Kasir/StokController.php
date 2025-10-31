<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $barang = Barang::when($search, function($query, $search) {
                return $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            })
            ->orderBy('nama_barang')
            ->paginate(20);
        
        return view('kasir.stok.index', compact('barang', 'search'));
    }
}
