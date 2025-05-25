@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col-md-8">
            <h3 class="fw-bold mb-4">Tambah Jadwal Shift <i class="lni lni-plus"></i></h3>

            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        {{-- @csrf --}}

                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Masukkan nama karyawan">
                        </div>

                        <div class="mb-3">
                            <label for="shift" class="form-label">Shift</label>
                            <select class="form-select" id="shift" name="shift">
                                <option selected disabled>Pilih shift</option>
                                <option value="pagi">Shift Pagi (07:00 - 15:00)</option>
                                <option value="siang">Shift Siang (15:00 - 23:00)</option>
                                <option value="malam">Shift Malam (23:00 - 07:00)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="waktu" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" class="form-control" id="waktu" name="waktu">
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary me-2">
                                <i class="lni lni-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="lni lni-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
