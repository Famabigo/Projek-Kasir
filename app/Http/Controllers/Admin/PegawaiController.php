<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        // Get all kasir users (with or without pegawai entry)
        $kasirUsers = User::where('role', 'kasir')->get();
        
        // Create pegawai entry for kasir who don't have one
        foreach ($kasirUsers as $kasir) {
            if (!$kasir->pegawai) {
                Pegawai::create([
                    'user_id' => $kasir->id,
                    'nama' => $kasir->name,
                ]);
            }
        }
        
        // Now get all pegawai with pagination
        $pegawai = Pegawai::with('user')->paginate(15);
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'kasir',
        ]);

        Pegawai::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        $pegawai->update($data);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai dihapus.');
    }
}
