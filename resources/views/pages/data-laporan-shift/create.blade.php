@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-4">Tambah Laporan Pergantian Shift</h3>
    <div class="card">
        <div class="card-body">
            <form>
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                    <input type="text" class="form-control" id="namaKaryawan" placeholder="Masukkan nama karyawan" required>
                </div>

                <div class="mb-3">
                    <label for="dariShift" class="form-label">Dari Shift</label>
                    <select class="form-select" id="dariShift" required>
                        <option selected disabled>Pilih shift asal</option>
                        <option>Shift Pagi</option>
                        <option>Shift Malam</option>
                        <option>Shift Dini Hari</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keShift" class="form-label">Ke Shift</label>
                    <select class="form-select" id="keShift" required>
                        <option selected disabled>Pilih shift tujuan</option>
                        <option>Shift Pagi</option>
                        <option>Shift Malam</option>
                        <option>Shift Dini Hari</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" placeholder="Masukkan judul laporan" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi laporan" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="datetime-local" class="form-control" id="waktu" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="2" placeholder="Masukkan alamat karyawan" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input class="form-control" type="file" id="gambar" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="#" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
