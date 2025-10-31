@extends('layouts.app')
@section('title','Tambah Pegawai')
@section('content')
<h1>Tambah Pegawai</h1>
<form method="POST" action="{{ route('admin.pegawai.store') }}">@csrf
  <div class="mb-3"><label>Nama</label><input name="nama" class="form-control"></div>
  <div class="mb-3"><label>Email</label><input name="email" type="email" class="form-control"></div>
  <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control"></div>
  <button class="btn btn-primary">Simpan</button>
</form>
@endsection
