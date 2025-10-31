<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // Ambil member lama dari tabel members
        $members = Member::paginate(20);
        
        // Ambil users yang sudah approved sebagai member
        $approvedUsers = User::where('member_status', 'approved')
            ->where('role', 'pembeli')
            ->latest('member_approved_at')
            ->get();
        
        return view('kasir.members.index', compact('members', 'approvedUsers'));
    }

    public function create()
    {
        return view('kasir.members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // Hash password
        $data['password'] = bcrypt($data['password']);
        
        // Set sebagai pembeli dan member approved langsung
        $data['role'] = 'pembeli';
        $data['member_status'] = 'approved';
        $data['member_approved_at'] = now();
        $data['approved_by'] = auth()->id();
        
        // Generate kode member
        $data['kode_member'] = User::generateKodeMember();
        
        // Create user
        $user = User::create($data);

        return redirect()->route('kasir.members.index')
            ->with('success', "Member {$user->name} berhasil ditambahkan dengan kode: {$user->kode_member}. Member langsung aktif dan dapat belanja dengan diskon 15% untuk pembelian minimal Rp 50.000.");
    }

    public function edit(Member $member)
    {
        return view('kasir.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'nama_member' => 'required|string',
            'no_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'diskon_member' => 'required|numeric|min:0|max:100',
        ]);

        $member->update($data);
        return redirect()->route('kasir.members.index')->with('success','Member diperbarui.');
    }
    
    public function updateDiskon(Request $request, $id)
    {
        $request->validate([
            'diskon_member' => 'required|numeric|min:0|max:100'
        ]);
        
        $user = User::findOrFail($id);
        
        if ($user->member_status !== 'approved') {
            return back()->with('error', 'User bukan member yang disetujui');
        }
        
        $user->update([
            'diskon_member' => $request->diskon_member
        ]);
        
        return back()->with('success', "Diskon member {$user->name} berhasil diupdate menjadi {$request->diskon_member}%");
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('kasir.members.index')->with('success','Member dihapus.');
    }
}
