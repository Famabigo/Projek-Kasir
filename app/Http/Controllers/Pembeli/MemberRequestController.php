<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pembeli.member-request', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Cek apakah sudah pernah request atau sudah jadi member
        if ($user->member_status !== 'none' && $user->member_status !== 'rejected') {
            return back()->with('error', 'Anda sudah pernah mengajukan permohonan member');
        }

        $user->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'member_status' => 'pending',
            'member_request_at' => now(),
            'reject_reason' => null
        ]);

        return redirect()->route('pembeli.dashboard')
            ->with('success', 'Permohonan keanggotaan member berhasil diajukan! Silakan tunggu persetujuan dari admin/kasir.');
    }
}
