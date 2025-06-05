@extends('layouts.app')

@section('content')
    @php
        $prefix = Auth::guard('admin')->check() ? 'admin' : 'shift-leader';
    @endphp

    <div class="main p-4">
        <div class="container-fluid">
            <h2 class="fw-bold mb-4">
                <i class="lni lni-calendar"></i> Detail Jadwal Shift
            </h2>

            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Jadwal Karyawan {{ $shift->name }}</h4>
                </div>

                <div class="card-body bg-light">
                    <table id="jadwalTable" class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Karyawan</th>
                                <th>Tanggal</th>
                                <th>Jam Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->employee->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <p class="mb-1"><strong>Shift:</strong> {{ $shift->name }}</p>
                        <p><strong>Waktu:</strong>
                            {{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}
                        </p>
                    </div>

                    <a href="{{ route($prefix . '.schedule.index') }}" class="btn btn-outline-secondary mt-3">
                        <i class="lni lni-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#jadwalTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                }
            });
        });
    </script>
@endpush
