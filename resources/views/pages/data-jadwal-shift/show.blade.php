@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col-md-8">
            <h3 class="fw-bold mb-4">Detail Jadwal Shift <i class="lni lni-calendar"></i></h3>

            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nama Karyawan</dt>
                        <dd class="col-sm-8">Rizki</dd>

                        <dt class="col-sm-4">Shift</dt>
                        <dd class="col-sm-8">Shift Pagi (07:00 - 15:00)</dd>

                        <dt class="col-sm-4">Tanggal & Waktu</dt>
                        <dd class="col-sm-8">2025-07-01 07:00</dd>
                    </dl>
                    <a href="" class="btn btn-secondary mt-3">
                        <i class="lni lni-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
