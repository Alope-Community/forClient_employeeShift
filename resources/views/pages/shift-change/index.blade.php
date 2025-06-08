@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp
        <div class="row">
            <div class="col">
                <h3 class="fw-bold mb-4">{{ __('Verifikasi Pergantian Shift') }} <i class="lni lni-agenda"></i></h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive-md rounded-4 shadow-sm">
                    <table id="laporanTable"
                        class="table table-sm table-bordered table-striped text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Nama Karyawan') }}</th>
                                <th>{{ __('Dari Shift') }}</th>
                                <th>{{ __('Ke Shift') }}</th>
                                <th>{{ __('Judul') }}</th>
                                <th>{{ __('Deskripsi') }}</th>
                                <th>{{ __('Waktu') }}</th>
                                <th>{{ __('Alamat') }}</th>
                                <th>{{ __('Gambar') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shiftChanges as $index => $change)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $change->shiftReport->employee->name ?? '-' }}</td>
                                    <td>{{ $change->shiftReport->fromShift->name ?? '-' }}</td>
                                    <td>{{ $change->shiftReport->toShift->name ?? '-' }}</td>
                                    <td>{{ $change->shiftReport->title }}</td>
                                    <td class="text-start text-wrap" style="min-width: 150px;">
                                        {{ $change->shiftReport->description }}
                                    </td>
                                    <td>{{ $change->shiftReport->time }}</td>
                                    <td class="text-start text-wrap" style="min-width: 150px;">
                                        {{ $change->shiftReport->address }}
                                    </td>
                                    <td>
                                        @if ($change->shiftReport->image)
                                            <img src="{{ asset('storage/' . $change->shiftReport->image) }}" alt="gambar"
                                                class="img-fluid rounded" style="width: 80px; height: auto;">
                                        @else
                                            <span class="text-muted">{{ __('Tidak ada') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($change->status === 'approved')
                                            <span class="badge bg-success">{{ __('Disetujui') }}</span>
                                        @elseif($change->status === 'rejected')
                                            <span class="badge bg-danger">{{ __('Ditolak') }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route($prefix . '.shift-change.show', $change->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            Detail
                                        </a> --}}
                                        @if ($change->status !== 'approved')
                                            <a href="{{ route($prefix . '.shift-change.edit', $change->id) }}"
                                                class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                                <i class="lni lni-pencil"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                "order": [
                    [0, "asc"]
                ],
                "lengthMenu": [5, 10, 25, 50],
                "pageLength": 5,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [8, 10]
                }]
            });
        });
    </script>
@endpush
