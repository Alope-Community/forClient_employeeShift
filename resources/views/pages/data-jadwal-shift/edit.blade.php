@extends('layouts.app')


@section('content')
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Jadwal Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" id="namaKaryawan" placeholder="Masukkan nama karyawan">
          </div>
          <div class="mb-3">
            <label for="shift" class="form-label">Shift</label>
            <select class="form-select" id="shift">
              <option value="">Pilih Shift</option>
              <option value="shiftPagi">Shift Pagi (07:00 - 15:00)</option>
              <option value="shiftSiang">Shift Siang (15:00 - 23:00)</option>
              <option value="shiftMalam">Shift Malam (23:00 - 07:00)</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tanggalWaktu" class="form-label">Tanggal & Waktu</label>
            <input type="datetime-local" class="form-control" id="tanggalWaktu">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection