@extends('layouts.app')

@section('content')
    @php
        $prefix = auth('admin')->check() ? 'admin' : 'shift-leader';
    @endphp

    <div class="main p-3 ms-5 mt-3">
        <div class="row">
            <div class="col">
                <h3 class="fw-bold mb-4">Jadwal Shift Karyawan <i class="lni lni-calendar"></i></h3>

                <div class="mb-3">
                    <a href="{{ route($prefix . '.schedule.create') }}" class="btn btn-primary">
                        <i class="lni lni-plus me-1"></i> Tambah Jadwal Shift
                    </a>
                </div>

                <div class="table-responsive-md rounded-4 shadow-sm">
                    <table id="shiftTable" class="table table-sm table-bordered table-striped text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Shift</th>
                                <th>Tanggal & Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $index => $schedule)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $schedule->employee->name ?? '-' }}</td>
                                    <td>
                                        {{ $schedule->shift->name ?? '-' }}
                                        @if ($schedule->shift)
                                            ({{ \Carbon\Carbon::parse($schedule->shift->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($schedule->shift->end_time)->format('H:i') }})
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d H:i') }}</td>
                                    <td class="d-flex flex-wrap justify-content-center gap-2">
                                        <a href="{{ route($prefix . '.schedule.show', $schedule->id) }}"
                                            class="btn btn-sm btn-info">Detail</a>

                                        <a href="{{ route($prefix . '.schedule.edit', $schedule->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="lni lni-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-route="{{ route($prefix . '.schedule.destroy', $schedule->id) }}"
                                            data-employee="{{ $schedule->employee->name ?? 'Karyawan tidak ditemukan' }}"
                                            data-date="{{ \Carbon\Carbon::parse($schedule->date)->format('Y-m-d H:i') }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus">
                                            <i class="lni lni-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteShiftForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Jadwal Shift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus jadwal shift untuk <strong id="shiftEmployeeName"></strong> pada <strong
                                id="shiftDate"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            Hapus
                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#shiftTable').DataTable();

            $('.delete-btn').click(function() {
                const url = $(this).data('route');
                const employeeName = $(this).data('employee');
                const shiftDate = $(this).data('date');

                $('#deleteShiftForm').attr('action', url);
                $('#shiftEmployeeName').text(employeeName);
                $('#shiftDate').text(shiftDate);
            });
        });
    </script>
@endpush
