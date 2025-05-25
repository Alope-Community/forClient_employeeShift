@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h3 class="fw-bold">Detail Data Shift <i class="lni lni-eye"></i></h3>

    <div class="card p-3" style="max-width: 600px;">
        <div class="mb-3">
            <strong>Nama Shift:</strong>
            <p>Shift Pagi</p>
        </div>
        <div class="mb-3">
            <strong>Grup Shift:</strong>
            <p>A</p>
        </div>
        <div class="mb-3">
            <strong>Jam Masuk:</strong>
            <p>08:00</p>
        </div>
        <div class="mb-3">
            <strong>Jam Keluar:</strong>
            <p>16:00</p>
        </div>

        <a href="#" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
