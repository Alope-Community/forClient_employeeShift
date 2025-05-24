@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
   <div class="row">
        <div class="col">
            <h3 class="fw-bold mb-4">Laporan Pergantian Shift <i class="lni lni-agenda"></i></h3>

            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Dari Shift</th>
                        <th>Ke Shift</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                        <th>Alamat</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rizki</td>
                        <td>Shift Pagi</td>
                        <td>Shift Malam</td>
                        <td>Penggantian Shift Mendadak</td>
                        <td class="text-start text-wrap" style="min-width: 150px;">Karyawan mengganti shift karena keperluan keluarga.</td>
                        <td>2025-06-21 08:00</td>
                        <td class="text-start text-wrap" style="min-width: 150px;">Jl. Merdeka No. 12</td>
                        <td>
                            <img src="{{ asset('storage/images/sample.jpg') }}" alt="gambar" class="img-fluid rounded" style="width: 80px; height: auto;">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                <i class="lni lni-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection