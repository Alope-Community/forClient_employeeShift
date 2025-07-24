@extends('layouts.app')

@section('title', 'Daftar Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Daftar Pergantian Shift')}}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ __('Terjadi kesalahan!') }}</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @auth('employee')
            <a href="{{ route('employee.leave-application.create') }}"
               class="btn btn-primary mb-3 d-block d-md-inline-block">
               {{ __('+ Ajukan Pergantian Shift')}}
            </a>
        @endauth

        <!-- Hanya bungkus tabel dengan table-responsive di layar kecil dan tablet -->
        <div class="d-block d-lg-none table-responsive">
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
                            <td>{{ $report->employee->name }}</td>
                            <td>{{ $report->fromShift->name }}</td>
                            <td>{{ $report->toShift->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->time)->format('d M Y') }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if ($report->shiftChange->status === 'pending')
                                    <span class="badge bg-warning text-dark">{{ __('Pending')}}</span>
                                @elseif ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">{{ __('Disetuju')}}i</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('Ditolak')}}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    @auth('employee')
                                        <a href="{{ route('employee.leave-application.show', $report->id) }}"
                                            class="btn btn-sm btn-info">{{ __('Detail')}}</a>

                                        <a href="{{ route('employee.leave-application.edit', $report->id) }}"
                                            class="btn btn-edit btn-sm btn-outline-primary me-1" title="Edit">
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
                                            class="btn btn-sm btn-info">{{ __('Detail')}}</a>

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
                            <td>{{ $report->employee->name }}</td>
                            <td>{{ $report->fromShift->name }}</td>
                            <td>{{ $report->toShift->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->time)->format('d M Y') }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if ($report->shiftChange->status === 'pending')
                                    <span class="badge bg-warning text-dark">{{ __('Pending')}}</span>
                                @elseif ($report->shiftChange->status === 'approved')
                                    <span class="badge bg-success text-white">{{ __('Disetuju')}}i</span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('Ditolak')}}</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="d-flex flex-wrap gap-1">
                                    @auth('employee')
                                        <a href="{{ route('employee.leave-application.show', $report->id) }}"
                                            class="btn btn-sm btn-info">{{ __('Detail')}}</a>

                                        <a href="{{ route('employee.leave-application.edit', $report->id) }}"
                                            class="btn btn-edit btn-sm btn-outline-primary me-1" title="Edit">
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
                                            class="btn btn-sm btn-info">{{ __('Detail')}}</a>

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
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Konfirmasi Hapus')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Apakah Anda yakin ingin menghapus pengajuan cuti dari')}} <strong id="employeeName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal')}}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Hapus')}}</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#reportTable').DataTable();
            $('#reportTableDesktop').DataTable();

            $('.delete-btn').on('click', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const role = $(this).data('role') || 'admin'; // default admin if role not set
                const url = `/${role}/leave-application/${id}`;

                $('#deleteForm').attr('action', url);
                $('#employeeName').text(name);
            });
        });
    </script>
@endpush
