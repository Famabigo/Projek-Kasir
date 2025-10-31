<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::paginate(20);
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image',
            'expired_at' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('admin.barang.index')->with('success', 'Barang ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'nullable|string',
            'ukuran' => 'nullable|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image',
            'expired_at' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('admin.barang.index')->with('success', 'Barang diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barang.index')->with('success', 'Barang dihapus.');
    }
}
