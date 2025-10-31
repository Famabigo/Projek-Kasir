@extends('layouts.app')
@section('title','Buat Transaksi')
@section('content')
<h1>Buat Transaksi</h1>
<form method="POST" action="{{ route('kasir.transaksi.store') }}">
  @csrf
  <div class="mb-3">
    <label>Member (opsional)</label>
    <select name="member_id" class="form-control">
      <option value="">-- Pilih --</option>
      @foreach($members as $m)
        <option value="{{ $m->id }}">{{ $m->nama_member }} ({{ $m->kode_member }})</option>
      @endforeach
    </select>
  </div>

  <h5>Item</h5>
  <div id="items">
    @foreach($barang as $b)
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="{{ $b->id }}" id="b{{ $b->id }}" data-harga="{{ $b->harga_jual }}">
        <label class="form-check-label" for="b{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual,0,',','.') }} (stok: {{ $b->stok }})</label>
        <input type="number" name="items[{{ $b->id }}][jumlah]" min="1" max="{{ $b->stok }}" class="form-control mt-1" placeholder="Jumlah">
        <input type="hidden" name="items[{{ $b->id }}][barang_id]" value="{{ $b->id }}">
      </div>
    @endforeach
  </div>

  <div class="mb-3 mt-3">
    <label>Diskon</label>
    <input type="number" name="diskon" class="form-control" value="0">
  </div>

  <button class="btn btn-success">Simpan Transaksi</button>
</form>
@endsection
