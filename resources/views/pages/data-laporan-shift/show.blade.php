@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-4">Detail Laporan Pergantian Shift</h3>
    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama Karyawan</dt>
                <dd class="col-sm-9">Rizki</dd>

                <dt class="col-sm-3">Dari Shift</dt>
                <dd class="col-sm-9">Shift Pagi</dd>

                <dt class="col-sm-3">Ke Shift</dt>
                <dd class="col-sm-9">Shift Malam</dd>

                <dt class="col-sm-3">Judul</dt>
                <dd class="col-sm-9">Penggantian Shift Mendadak</dd>

                <dt class="col-sm-3">Deskripsi</dt>
                <dd class="col-sm-9">Karyawan mengganti shift karena keperluan keluarga.</dd>

                <dt class="col-sm-3">Waktu</dt>
                <dd class="col-sm-9">2025-06-21 08:00</dd>

                <dt class="col-sm-3">Alamat</dt>
                <dd class="col-sm-9">Jl. Merdeka No. 12</dd>

                <dt class="col-sm-3">Gambar</dt>
                <dd class="col-sm-9">
                    <img src="https://via.placeholder.com/300x200.png?text=Gambar+Laporan" alt="Gambar Laporan" class="img-fluid rounded" style="max-width: 300px;">
                </dd>
            </dl>
            <a href="#" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
