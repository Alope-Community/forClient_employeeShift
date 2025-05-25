@extends('layouts.app')

@section('title', 'Daftar Pengajuan Cuti')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h1 class="mb-4">Daftar Pengajuan Cuti</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('leave-application.create') }}" class="btn btn-primary mb-3">+ Ajukan Cuti</a>

    <div class="table-responsive">
        <table id="reportTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Dari Shift</th>
                    <th>Kepada Shift</th>
                    <th>Tanggal Cuti</th>
                    <th>Judul</th>
                    <th>Alasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->employee->name }}</td>
                    <td>{{ $report->fromShift->name }}</td>
                    <td>{{ $report->toShift->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->time)->format('d M Y') }}</td>
                    <td>{{ $report->title }}</td>
                    <td>{{ $report->description }}</td>
                    <td>
                        <a href="{{ route('leave-application.show', $report->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('leave-application.edit', $report->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('leave-application.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
