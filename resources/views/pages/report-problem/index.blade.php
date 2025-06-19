@extends('layouts.app')

@section('title', 'Daftar Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Daftar Laporan Permasalahan Shift') }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @auth('employee')
            <a href="{{ route('employee.report-problem.create') }}" class="btn btn-primary mb-3 d-block d-md-inline-block">
                {{ __('+ Ajukan Laporan Permasalahan Shift') }}
            </a>
        @endauth

        <!-- Hanya bungkus tabel dengan table-responsive di layar kecil dan tablet -->
        <div class="d-block d-lg-none table-responsive">
            <table id="reportTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('No') }}</th>
                        <th>{{ __('Nama Karyawan') }}</th>
                        <th>{{ __('Judul') }}</th>
                        <th>{{ __('Alasan') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->fromEmployee->name }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if ($report->shiftChange->status === 'pending')
                                    <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                @elseif ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">{{ __('Disetuju') }}i</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('Ditolak') }}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    @auth('employee')
                                        <a href="{{ route('employee.report-problem.show', $report->id) }}"
                                            class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                        <a href="{{ route('employee.report-problem.edit', $report->id) }}"
                                            class="btn btn-edit btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $report->id }}"
                                            data-name="{{ $report->fromEmployee->name }}" data-role="employee" title="Hapus">
                                            <i class="lni lni-trash"></i>
                                        </button>
                                    @endauth

                                    @php
                                        $prefix = auth('admin')->check()
                                            ? 'admin'
                                            : (auth('shift_leader')->check()
                                                ? 'shift-leader'
                                                : null);
                                    @endphp

                                    @if ($prefix !== null)
                                        <a href="{{ route($prefix . '.report-problem.edit', $report->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel asli tanpa pembungkus responsive untuk layar besar -->
        <div class="d-none d-lg-block">
            <table id="reportTableDesktop" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('No') }}</th>
                        <th>{{ __('Nama Karyawan') }}</th>
                        <th>{{ __('Judul') }}</th>
                        <th>{{ __('Alasan') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->fromEmployee->name }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if ($report->shiftChange->status === 'pending')
                                    <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                @elseif ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">{{ __('Disetuju') }}i</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('Ditolak') }}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    @auth('employee')
                                        <a href="{{ route('employee.report-problem.show', $report->id) }}"
                                            class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                        <a href="{{ route('employee.report-problem.edit', $report->id) }}"
                                            class="btn btn-edit btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $report->id }}"
                                            data-name="{{ $report->fromEmployee->name }}" data-role="employee" title="Hapus">
                                            <i class="lni lni-trash"></i>
                                        </button>
                                    @endauth

                                    @php
                                        $prefix = auth('admin')->check()
                                            ? 'admin'
                                            : (auth('shift_leader')->check()
                                                ? 'shift-leader'
                                                : null);
                                    @endphp

                                    @if ($prefix !== null)
                                        <a href="{{ route($prefix . '.report-problem.edit', $report->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="lni lni-pencil"></i>
                                        </a>
                                    @endif
                                </div>
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
                        <h5 class="modal-title" id="deleteModalLabel">{{ __('Konfirmasi Hapus') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Apakah Anda yakin ingin menghapus pengajuan cuti dari') }} <strong
                                id="employeeName"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Batal') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Hapus') }}</button>
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
            $('#reportTableDesktop').DataTable();

            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const role = $(this).data('role') || 'admin'; // default admin if role not set
                const url = `/${role}/shift-problem/${id}`;

                $('#deleteForm').attr('action', url);
                $('#employeeName').text(name);
            });
        });
    </script>
@endpush
