@extends('layouts.app')
@section('title','Edit Pegawai')
@section('content')
<h1>Edit Pegawai</h1>
<form method="POST" action="{{ route('admin.pegawai.update',$pegawai) }}">@csrf @method('PUT')
  <div class="mb-3"><label>Nama</label><input name="nama" value="{{ $pegawai->nama }}" class="form-control"></div>
  <div class="mb-3"><label>Alamat</label><input name="alamat" value="{{ $pegawai->alamat }}" class="form-control"></div>
  <div class="mb-3"><label>No Telp</label><input name="no_telp" value="{{ $pegawai->no_telp }}" class="form-control"></div>
  <button class="btn btn-primary">Simpan</button>
</form>
@endsection
