@extends('layouts.app')


@section('content')

<!-- Modal Edit -->
<div class="modal fade" id="editShiftModal" tabindex="-1" aria-labelledby="editShiftModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="#">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editShiftModalLabel">Edit Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="namaShift" class="form-label">Nama Shift</label>
            <input type="text" class="form-control" id="namaShift" name="namaShift" value="">
          </div>
          <div class="mb-3">
            <label for="grupShift" class="form-label">Grup Shift</label>
            <input type="text" class="form-control" id="grupShift" name="grupShift" value="">
          </div>
          <div class="mb-3">
            <label for="jamMasuk" class="form-label">Jam Masuk</label>
            <input type="time" class="form-control" id="jamMasuk" name="jamMasuk" value="">
          </div>
          <div class="mb-3">
            <label for="jamKeluar" class="form-label">Jam Keluar</label>
            <input type="time" class="form-control" id="jamKeluar" name="jamKeluar" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection