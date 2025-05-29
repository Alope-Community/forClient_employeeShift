@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp
        <h3 class="fw-bold mb-4">Detail Pergantian Shift</h3>
        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Nama Karyawan</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->employee->name }}</dd>

                    <dt class="col-sm-4">Dari Shift</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->fromShift->name }}</dd>

                    <dt class="col-sm-4">Ke Shift</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->toShift->name }}</dd>

                    <dt class="col-sm-4">Judul Laporan</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->title }}</dd>

                    <dt class="col-sm-4">Deskripsi</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->description }}</dd>

                    <dt class="col-sm-4">Waktu Pergantian</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->time }}</dd>

                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8">{{ $shiftChange->shiftReport->address }}</dd>

                    <dt class="col-sm-4">Gambar</dt>
                    <dd class="col-sm-8">
                        @if ($shiftChange->shiftReport->image)
                            <img src="{{ asset('storage/' . $shiftChange->shiftReport->image) }}" alt="Gambar"
                                class="img-fluid rounded" style="max-width: 300px;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        @if ($shiftChange->status === 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($shiftChange->status === 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Disetujui Oleh</dt>
                    <dd class="col-sm-8">
                        {{ $shiftChange->approver->name ?? 'Belum disetujui' }}
                    </dd>

                    <dt class="col-sm-4">Tanggal Persetujuan</dt>
                    <dd class="col-sm-8">
                        {{ $shiftChange->approved_at ?? '-' }}
                    </dd>
                </dl>

                <a href="{{ route($prefix . '.shift-change.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
