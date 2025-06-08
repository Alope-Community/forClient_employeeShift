@extends('layouts.app')

@section('title', 'Daftar Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Riwayat Pergantian Shift')}}</h1>

        <div class="table-responsive">
            <table id="reportTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('No')}}</th>
                        <th>{{ __('Nama Karyawan')}}</th>
                        <th>{{ __('Dari Shift')}}</th>
                        <th>{{ __('Kepada Shift')}}</th>
                        <th>{{ __('Tanggal Mulai')}}</th>
                        <th>{{ __('Judul')}}</th>
                        <th>{{ __('Alasan')}}</th>
                        <th>{{ __('Status')}}</th>
                        <th>{{ __('Aksi')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->employee?->name ?? '-' }}</td>
                            <td>{{ $report->fromShift?->name ?? '-' }}</td>
                            <td>{{ $report->toShift?->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->time)->format('d M Y') }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">{{ __('Disetujui')}}</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('Ditolak')}}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('employee.shift-history.show', $report->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Detail')}}</a>
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
