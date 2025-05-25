@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h3 class="fw-bold">Tambah Data Shift <i class="lni lni-plus"></i></h3>

    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Shift</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama shift" required>
        </div>

        <div class="mb-3">
            <label for="group" class="form-label">Grup Shift</label>
            <input type="text" name="group" id="group" class="form-control" placeholder="Masukkan grup shift" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Jam Masuk</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Jam Keluar</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>
@endsection
