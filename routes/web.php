<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kasir\TransaksiController as KasirTransaksiController;
use App\Http\Controllers\Kasir\MemberController as KasirMemberController;
use App\Http\Controllers\Kasir\StokController as KasirStokController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Temporary check route (remove in production)
Route::get('/check-data', function() {
    echo "<h2>Users:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Member Status</th></tr>";
    foreach(\App\Models\User::all() as $u) {
        echo "<tr>";
        echo "<td>{$u->id}</td>";
        echo "<td>{$u->name}</td>";
        echo "<td>{$u->email}</td>";
        echo "<td>{$u->role}</td>";
        echo "<td>{$u->member_status}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Pegawai:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nama</th><th>User Email</th></tr>";
    foreach(\App\Models\Pegawai::with('user')->get() as $p) {
        echo "<tr>";
        echo "<td>{$p->id}</td>";
        echo "<td>{$p->nama}</td>";
        echo "<td>" . ($p->user ? $p->user->email : 'none') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Barang:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th></tr>";
    foreach(\App\Models\Barang::all() as $b) {
        echo "<tr>";
        echo "<td>{$b->id}</td>";
        echo "<td>{$b->nama_barang}</td>";
        echo "<td>{$b->kategori}</td>";
        echo "<td>Rp " . number_format($b->harga, 0, ',', '.') . "</td>";
        echo "<td>{$b->stok}</td>";
        echo "</tr>";
    }
    echo "</table>";
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function(){
        $role = auth()->user()->role ?? 'pembeli';
        if($role === 'admin') return redirect()->route('admin.dashboard');
        if($role === 'kasir') return redirect()->route('kasir.dashboard');
        return redirect()->route('pembeli.dashboard');
    })->name('dashboard');

        // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('barang', BarangController::class);
        
        // Settings routes
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
        
        // Laporan routes
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{id}/detail', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::get('/laporan/pesanan/{id}/detail', [LaporanController::class, 'detailPesanan'])->name('laporan.detail-pesanan');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
        
        // Member Approval routes
        Route::get('/member-approval', [\App\Http\Controllers\Admin\MemberApprovalController::class, 'index'])->name('member-approval.index');
        Route::post('/member-approval/{id}/approve', [\App\Http\Controllers\Admin\MemberApprovalController::class, 'approve'])->name('member-approval.approve');
        Route::post('/member-approval/{id}/reject', [\App\Http\Controllers\Admin\MemberApprovalController::class, 'reject'])->name('member-approval.reject');
        Route::post('/member-approval/{id}/revoke', [\App\Http\Controllers\Admin\MemberApprovalController::class, 'revoke'])->name('member-approval.revoke');
        
        // Notifikasi Laporan Barang routes
        Route::get('/notifikasi', [\App\Http\Controllers\Admin\NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::post('/notifikasi/{id}/update-status', [\App\Http\Controllers\Admin\NotifikasiController::class, 'updateStatus'])->name('notifikasi.update-status');
        Route::get('/notifikasi/count', [\App\Http\Controllers\Admin\NotifikasiController::class, 'getCount'])->name('notifikasi.count');
    });

    // Kasir routes
    Route::prefix('kasir')->name('kasir.')->middleware('role:kasir')->group(function(){
        Route::get('/dashboard', function(){ return view('kasir.dashboard'); })->name('dashboard');
        Route::resource('transaksi', KasirTransaksiController::class)->only(['index','create','store','show']);
        Route::get('/transaksi/{transaksi}/cetak-struk', [KasirTransaksiController::class, 'cetakStruk'])->name('transaksi.cetak-struk');
        
        // Pesanan routes
        Route::get('/pesanan/{id}/detail', [KasirTransaksiController::class, 'getPesananDetail']);
        Route::post('/pesanan/{id}/update-status', [KasirTransaksiController::class, 'updatePesananStatus']);
        Route::post('/pesanan/{id}/set-jadwal-ambil', [KasirTransaksiController::class, 'setJadwalAmbil']);
        Route::post('/pesanan/{id}/konfirmasi-pengambilan', [KasirTransaksiController::class, 'konfirmasiPengambilan']);
        
        Route::resource('members', KasirMemberController::class);
        Route::put('/members/{id}/update-diskon', [KasirMemberController::class, 'updateDiskon'])->name('members.update-diskon');
        Route::get('/stok', [KasirStokController::class, 'index'])->name('stok.index');
        
        // Member Approval routes
        Route::get('/member-approval', [\App\Http\Controllers\Kasir\MemberApprovalController::class, 'index'])->name('member-approval.index');
        Route::post('/member-approval/{id}/approve', [\App\Http\Controllers\Kasir\MemberApprovalController::class, 'approve'])->name('member-approval.approve');
        Route::post('/member-approval/{id}/reject', [\App\Http\Controllers\Kasir\MemberApprovalController::class, 'reject'])->name('member-approval.reject');
        
        // Laporan Barang routes
        Route::get('/laporan-barang', [\App\Http\Controllers\Kasir\LaporanBarangController::class, 'index'])->name('laporan-barang.index');
        Route::post('/laporan-barang', [\App\Http\Controllers\Kasir\LaporanBarangController::class, 'store'])->name('laporan-barang.store');
        
        // Laporan Penjualan routes
        Route::get('/laporan', [\App\Http\Controllers\Kasir\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{id}/detail', [\App\Http\Controllers\Kasir\LaporanController::class, 'detail'])->name('laporan.detail');
        Route::get('/laporan/pesanan/{id}/detail', [\App\Http\Controllers\Kasir\LaporanController::class, 'detailPesanan'])->name('laporan.detail-pesanan');
        Route::get('/laporan/pdf', [\App\Http\Controllers\Kasir\LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('/laporan/excel', [\App\Http\Controllers\Kasir\LaporanController::class, 'exportExcel'])->name('laporan.excel');
    });

    // Pembeli routes
    Route::prefix('pembeli')->name('pembeli.')->middleware('role:pembeli')->group(function(){
        Route::get('/dashboard', [\App\Http\Controllers\Pembeli\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/product/{id}', [\App\Http\Controllers\Pembeli\ProductController::class, 'show'])->name('product.show');
        
        // Cart routes
        Route::get('/cart', [\App\Http\Controllers\Pembeli\CartController::class, 'index'])->name('cart');
        Route::post('/cart/add/{id}', [\App\Http\Controllers\Pembeli\CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/add-bulk', [\App\Http\Controllers\Pembeli\CartController::class, 'addBulk'])->name('cart.add-bulk');
        Route::patch('/cart/update/{id}', [\App\Http\Controllers\Pembeli\CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove/{id}', [\App\Http\Controllers\Pembeli\CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart/clear', [\App\Http\Controllers\Pembeli\CartController::class, 'clear'])->name('cart.clear');
        
        // Checkout & Pesanan routes
        Route::get('/checkout', [\App\Http\Controllers\Pembeli\CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [\App\Http\Controllers\Pembeli\CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/pesanan', [\App\Http\Controllers\Pembeli\CheckoutController::class, 'pesanan'])->name('pesanan.index');
        Route::get('/pesanan/{id}', [\App\Http\Controllers\Pembeli\CheckoutController::class, 'show'])->name('pesanan.show');
        Route::post('/pesanan/{id}/cancel', [\App\Http\Controllers\Pembeli\CheckoutController::class, 'cancel'])->name('pesanan.cancel');
        
        // Member Request routes
        Route::get('/member-request', [\App\Http\Controllers\Pembeli\MemberRequestController::class, 'index'])->name('member-request.index');
        Route::post('/member-request', [\App\Http\Controllers\Pembeli\MemberRequestController::class, 'store'])->name('member-request.store');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
