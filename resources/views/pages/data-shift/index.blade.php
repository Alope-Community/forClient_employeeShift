@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <div class="row">
            <div class="col">
                <h3 class="fw-bold"><i class="lni lni-timer"></i> {{ __('Data Shift')}}</h3>

                @php
                    $prefix = auth('admin')->check()
                        ? 'admin'
                        : (auth('shift_leader')->check()
                            ? 'shift-leader'
                            : null);
                @endphp

                <div class="mb-3">
                    @if ($prefix)
                        <a href="{{ route($prefix . '.shift.create') }}" class="btn btn-primary">
                            <i class="lni lni-plus"></i> {{ __('Tambah Shift')}}
                        </a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table id="shiftTable" class="table table-bordered align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>{{ __('No')}}</th>
                                <th>{{ __('Nama Shift')}}</th>
                                <th>{{ __('Grup Shift')}}</th>
                                <th>{{ __('Jam Masuk')}}</th>
                                <th>{{ __('Jam Keluar')}}</th>
                                <th>{{ __('Aksi')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($shifts as $index => $shift)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $shift->name }}</td>
                                    <td>{{ $shift->group }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                                    <td>
                                        @if ($prefix)
                                            <a href="{{ route($prefix . '.shift.edit', $shift->id) }}"
                                                class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                                <i class="lni lni-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger delete-btn"
                                                data-id="{{ $shift->id }}" title="Hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteShiftModal">
                                                <i class="lni lni-trash"></i>
                                            </button>
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

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteShiftModal" tabindex="-1" aria-labelledby="deleteShiftModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="deleteShiftForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteShiftModalLabel">{{ __('Hapus Shift')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Apakah Anda yakin ingin menghapus data shift ini?')}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">{{ __('Hapus')}}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#shiftTable').DataTable({
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    orderable: false,
                    targets: 5
                }]
            });

            $('.delete-btn').click(function() {
                const shiftId = $(this).data('id');
                const prefix =
                    "{{ auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'leader' : '') }}";
                const url = `/${prefix}/shift/${shiftId}`; // sesuai route resource
                $('#deleteShiftForm').attr('action', url);
            });
        });
    </script>
@endpush
