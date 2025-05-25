
@extends('layouts.app')

@section('content')
<!-- Modal Edit -->
<div class="modal fade" id="editLaporanModal" tabindex="-1" aria-labelledby="editLaporanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editLaporanForm" action="javascript:void(0);">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLaporanLabel">Edit Laporan Pergantian Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" id="editNama" name="nama" placeholder="Nama Karyawan">
          </div>
          <div class="row">
            <div class="mb-3 col">
              <label for="editDariShift" class="form-label">Dari Shift</label>
              <input type="text" class="form-control" id="editDariShift" name="darishift" placeholder="Dari Shift">
            </div>
            <div class="mb-3 col">
              <label for="editKeShift" class="form-label">Ke Shift</label>
              <input type="text" class="form-control" id="editKeShift" name="keshift" placeholder="Ke Shift">
            </div>
          </div>
          <div class="mb-3">
            <label for="editJudul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="editJudul" name="judul" placeholder="Judul">
          </div>
          <div class="mb-3">
            <label for="editDeskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"></textarea>
          </div>
          <div class="mb-3">
            <label for="editWaktu" class="form-label">Waktu</label>
            <input type="datetime-local" class="form-control" id="editWaktu" name="waktu">
          </div>
          <div class="mb-3">
            <label for="editAlamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="editAlamat" name="alamat" rows="2" placeholder="Alamat"></textarea>
          </div>
          <div class="mb-3">
            <label for="editGambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="editGambar" name="gambar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection