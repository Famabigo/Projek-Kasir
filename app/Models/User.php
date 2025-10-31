<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat',
        'member_status',
        'kode_member',
        'diskon_member',
        'member_request_at',
        'member_approved_at',
        'approved_by',
        'reject_reason'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'member_request_at' => 'datetime',
        'member_approved_at' => 'datetime',
    ];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public static function generateKodeMember()
    {
        $lastMember = self::where('member_status', 'approved')
            ->whereNotNull('kode_member')
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastMember && $lastMember->kode_member) {
            $lastNumber = (int) substr($lastMember->kode_member, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return 'MBR' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function isRole(string $role)
    {
        return $this->role === $role;
    }

    public function pegawai()
    {
        return $this->hasOne(\App\Models\Pegawai::class, 'user_id');
    }
}
