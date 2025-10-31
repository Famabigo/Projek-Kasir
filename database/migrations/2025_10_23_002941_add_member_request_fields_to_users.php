<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->enum('member_status', ['none', 'pending', 'approved', 'rejected'])->default('none')->after('role');
            $table->string('kode_member')->nullable()->unique()->after('member_status');
            $table->timestamp('member_request_at')->nullable()->after('kode_member');
            $table->timestamp('member_approved_at')->nullable()->after('member_request_at');
            $table->unsignedBigInteger('approved_by')->nullable()->after('member_approved_at');
            $table->text('reject_reason')->nullable()->after('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'no_hp',
                'alamat',
                'member_status',
                'kode_member',
                'member_request_at',
                'member_approved_at',
                'approved_by',
                'reject_reason'
            ]);
        });
    }
};
