@extends('layouts.app')

@section('title', 'Daftar Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-3 mt-3">
        <h1 class="mb-4">Daftar Pergantian Shift</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @auth('employee')
            <a href="{{ route('employee.leave-application.create') }}" class="btn btn-primary mb-3">+ Ajukan Pergantian Shift</a>
        @endauth

        <div class="table-responsive">
            <table id="reportTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Dari Shift</th>
                        <th>Kepada Shift</th>
                        <th>Tanggal Mulai</th>
                        <th>Judul</th>
                        <th>Alasan</th>
                        <th>Status</th>
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
                                @if ($report->shiftChange->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">Disetujui</span>
                                @else
                                    <span class="badge bg-danger text-white">Ditolak</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                @auth('employee')
                                    <a href="{{ route('employee.leave-application.show', $report->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ route('employee.leave-application.edit', $report->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="{{ route('employee.leave-application.destroy', $report->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                    @endauth
                                    @auth('admin')
                                    <a href="{{ route('admin.leave-application.show', $report->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ route('admin.leave-application.edit', $report->id) }}"
                                        class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="{{ route('admin.leave-application.destroy', $report->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable();
        });
    </script>
@endpush
