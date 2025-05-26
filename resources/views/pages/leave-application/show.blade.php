@extends('layouts.app')

@section('title', 'Detail Pengajuan Cuti')

@section('content')
    <div class="main p-3 ms-3 mt-3">
        <h1 class="mb-4">Detail Pengajuan Cuti</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $shiftReport->title }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    Diajukan oleh: {{ $shiftReport->employee->name }} pada
                    {{ \Carbon\Carbon::parse($shiftReport->time)->translatedFormat('d M Y, H:i') }}
                </h6>

                <dl class="row">
                    <dt class="col-sm-3">Dari Shift</dt>
                    <dd class="col-sm-9">{{ $shiftReport->fromShift->name }}</dd>

                    <dt class="col-sm-3">Ke Shift</dt>
                    <dd class="col-sm-9">{{ $shiftReport->toShift->name }}</dd>

                    <dt class="col-sm-3">Alamat</dt>
                    <dd class="col-sm-9">{{ $shiftReport->address }}</dd>

                    <dt class="col-sm-3">Alasan</dt>
                    <dd class="col-sm-9">{{ $shiftReport->description }}</dd>

                    @if ($shiftReport->image)
                        <dt class="col-sm-3">Bukti Pendukung</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/' . $shiftReport->image) }}" alt="Bukti"
                                class="img-fluid rounded" style="max-height: 300px;">
                        </dd>
                    @endif

                    @if ($shiftReport->shiftChange)
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <span
                                class="badge 
                            @if ($shiftReport->shiftChange->status === 'approved') bg-success 
                            @elseif($shiftReport->shiftChange->status === 'rejected') bg-danger 
                            @else bg-warning text-dark @endif">
                                {{ ucfirst($shiftReport->shiftChange->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Disetujui Oleh</dt>
                        <dd class="col-sm-9">{{ $shiftReport->shiftChange->approver->name ?? '-' }}</dd>

                        <dt class="col-sm-3">Tanggal Persetujuan</dt>
                        <dd class="col-sm-9">
                            {{ $shiftReport->shiftChange->approved_at ? \Carbon\Carbon::parse($shiftReport->shiftChange->approved_at)->translatedFormat('d M Y, H:i') : '-' }}
                        </dd>
                    @endif
                </dl>

                @auth('employee')
                    <a href="{{ route('employee.leave-application.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                @endauth
                @auth
                    <a href="{{ route('admin.leave-application.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
