<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all available products
        $barangs = Barang::where('stok', '>', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('pembeli.dashboard', compact('barangs'));
    }
}
