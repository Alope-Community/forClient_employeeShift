@extends('layouts.app')

@section('title', 'Daftar Pengajuan Cuti')

@section('content')
    <div class="main p-3 ms-3 mt-3">
        <h1 class="mb-4">Daftar Pergantian Shift</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @auth('employee')
            <a href="{{ route('employee.leave-application.create') }}" class="btn btn-primary mb-3">+ Ajukan Cuti</a>
        @endauth

        <div class="table-responsive">
            <table id="reportTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Dari Shift</th>
                        <th>Kepada Shift</th>
                        <th>Tanggal Cuti</th>
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
                                    class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $report->id }}"
                                    data-name="{{ $report->employee->name }}"
                                    data-role="employee"
                                    title="Hapus">
                                    <i class="lni lni-trash"></i>
                                </button>
                            @endauth

                            @auth('admin')
                                <a href="{{ route('admin.leave-application.show', $report->id) }}"
                                    class="btn btn-sm btn-info">Detail</a>

                                <a href="{{ route('admin.leave-application.edit', $report->id) }}"
                                    class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="lni lni-pencil"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $report->id }}"
                                    data-name="{{ $report->employee->name }}"
                                    title="Hapus">
                                    <i class="lni lni-trash"></i>
                                </button>

                            @endauth
                        </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengajuan cuti dari <strong id="employeeName"></strong>?</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
            </div>
        </div>
    </div>
        <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                <p>Yakin ingin menghapus pengajuan dari <strong id="employeeName"></strong>?</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#reportTable').DataTable();
        });
                // Modal konfirmasi hapus
        $('.delete-btn').on('click', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var role = @json(auth('admin')->check() ? 'admin' : 'employee');
            var actionUrl = `/` + role + `/leave-application/` + id;

            $('#deleteForm').attr('action', actionUrl);
            $('#employeeName').text(name);
        });
        $(document).ready(function () {
            $('#reportTable').DataTable();

            $('.delete-btn').on('click', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const role = $(this).data('role');
                const url = `/${role}/leave-application/${id}`;

                $('#deleteForm').attr('action', url);
                $('#employeeName').text(name);
            });
        });
    </script>
@endpush
