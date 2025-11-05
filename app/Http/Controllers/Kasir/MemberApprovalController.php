<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberApprovalController extends Controller
{
    public function index()
    {
        $pendingMembers = User::where('role', 'pembeli')
            ->where('member_status', 'pending')
            ->orderBy('member_request_at', 'desc')
            ->get();

        $approvedMembers = User::where('role', 'pembeli')
            ->where('member_status', 'approved')
            ->orderBy('member_approved_at', 'desc')
            ->paginate(20);

        return view('kasir.member-approval.index', compact('pendingMembers', 'approvedMembers'));
    }

    public function approve(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->member_status !== 'pending') {
            return back()->with('error', 'User tidak dalam status pending');
        }

        $user->update([
            'member_status' => 'approved',
            'kode_member' => User::generateKodeMember(),
            'member_approved_at' => now(),
            'approved_by' => Auth::id(),
            'reject_reason' => null,
            'diskon_member' => 15 // Auto set 15% discount for approved members
        ]);

        return back()->with('success', "Member {$user->name} berhasil disetujui dengan kode: {$user->kode_member}. Member akan otomatis mendapat diskon 15% untuk belanja minimal Rp 50.000");
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:500'
        ]);

        $user = User::findOrFail($id);

        if ($user->member_status !== 'pending') {
            return back()->with('error', 'User tidak dalam status pending');
        }

        $user->update([
            'member_status' => 'rejected',
            'reject_reason' => $request->reject_reason,
        ]);

        return back()->with('success', "Permohonan member {$user->name} ditolak");
    }
}
