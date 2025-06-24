@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h3 class="fw-bold mb-3"><i class="lni lni-users"></i> {{ __('Manajemen Pengguna') }}</h3>

        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp

        @auth('admin')
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-4">
                <i class="lni lni-plus"></i>{{ __('Tambah Pengguna') }}
            </a>
        @endauth

        @auth('shift_leader')
            <a href="{{ route('shift-leader.user.create') }}" class="btn btn-primary mb-4">
                <i class="lni lni-plus"></i>{{ __('Tambah Pengguna') }}
            </a>
        @endauth

        {{-- Unit Personnel --}}
        <div class="table-responsive mt-5">
            <table id="unit-table" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                    <tr class="table-dark">
                        <th colspan="9" class="text-center">{{ __('Unit Personnel') }}</th>
                    </tr>
                    <tr class="table-dark">
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Nomor Telepon') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th style="width: 15%">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $item)
                        @if ($item['model']->division === 'Unit Personnel')
                            <tr>
                                <td>{{ $item['model']->name }}</td>
                                <td>{{ $item['model']->email ?? '-' }}</td>
                                <td>{{ $item['model']->username ?? '-' }}</td>
                                <td>{{ $item['model']->gender ?? '-' }}</td>
                                <td>{{ $item['model']->address ?? '-' }}</td>
                                <td>{{ $item['model']->phone_number ?? '-' }}</td>
                                <td>
                                    @if ($item['role'] === 'Admin')
                                        <span class="badge bg-info text-dark">{{ __('Admin') }}</span>
                                    @elseif ($item['role'] === 'Shift Leader')
                                        <span class="badge bg-warning text-dark">{{ __('Shift Leader') }}</span>
                                    @else
                                        <span class="badge bg-success text-white">{{ __('Employee') }}</span>
                                    @endif
                                </td>
                                <td class="d-flex flex-wrap justify-content-center gap-2">

                                    <a href="{{ route($prefix . '.user.show', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                    <a href="{{ route($prefix . '.user.edit', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </a>

                                    <button class="btn btn-sm btn-outline-danger delete-btn"
                                        data-id="{{ $item['model']->id }}"
                                        data-role="{{ strtolower(str_replace(' ', '_', $item['role'])) }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal" title="Hapus">
                                        <i class="lni lni-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- WTP Personnel --}}
        <div class="table-responsive mt-5">
            <table id="wtp-table" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                    <tr class="table-dark">
                        <th colspan="9" class="text-center">{{ __('WTP Personnel') }}</th>
                    </tr>
                    <tr class="table-dark">
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Nomor Telepon') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th style="width: 15%">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $item)
                        @if ($item['model']->division === 'WTP Personnel')
                            <tr>
                                <td>{{ $item['model']->name }}</td>
                                <td>{{ $item['model']->email ?? '-' }}</td>
                                <td>{{ $item['model']->username ?? '-' }}</td>
                                <td>{{ $item['model']->gender ?? '-' }}</td>
                                <td>{{ $item['model']->address ?? '-' }}</td>
                                <td>{{ $item['model']->phone_number ?? '-' }}</td>
                                <td>
                                    @if ($item['role'] === 'Admin')
                                        <span class="badge bg-info text-dark">{{ __('Admin') }}</span>
                                    @elseif ($item['role'] === 'Shift Leader')
                                        <span class="badge bg-warning text-dark">{{ __('Shift Leader') }}</span>
                                    @else
                                        <span class="badge bg-success text-white">{{ __('Employee') }}</span>
                                    @endif
                                </td>
                                <td class="d-flex flex-wrap justify-content-center gap-2">

                                    <a href="{{ route($prefix . '.user.show', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                    <a href="{{ route($prefix . '.user.edit', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </a>

                                    <button class="btn btn-sm btn-outline-danger delete-btn"
                                        data-id="{{ $item['model']->id }}"
                                        data-role="{{ strtolower(str_replace(' ', '_', $item['role'])) }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal" title="Hapus">
                                        <i class="lni lni-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Ash FGD Personnel --}}
        <div class="table-responsive mt-5">
            <table id="ash-fgd-table" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                    <tr class="table-dark">
                        <th colspan="9" class="text-center">{{ __('Ash FGD Personnel') }}</th>
                    </tr>
                    <tr class="table-dark">
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Nomor Telepon') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th style="width: 15%">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $item)
                        @if ($item['model']->division === 'Ash FGD Personnel')
                            <tr>
                                <td>{{ $item['model']->name }}</td>
                                <td>{{ $item['model']->email ?? '-' }}</td>
                                <td>{{ $item['model']->username ?? '-' }}</td>
                                <td>{{ $item['model']->gender ?? '-' }}</td>
                                <td>{{ $item['model']->address ?? '-' }}</td>
                                <td>{{ $item['model']->phone_number ?? '-' }}</td>
                                <td>
                                    @if ($item['role'] === 'Admin')
                                        <span class="badge bg-info text-dark">{{ __('Admin') }}</span>
                                    @elseif ($item['role'] === 'Shift Leader')
                                        <span class="badge bg-warning text-dark">{{ __('Shift Leader') }}</span>
                                    @else
                                        <span class="badge bg-success text-white">{{ __('Employee') }}</span>
                                    @endif
                                </td>
                                <td class="d-flex flex-wrap justify-content-center gap-2">

                                    <a href="{{ route($prefix . '.user.show', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                    <a href="{{ route($prefix . '.user.edit', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </a>

                                    <button class="btn btn-sm btn-outline-danger delete-btn"
                                        data-id="{{ $item['model']->id }}"
                                        data-role="{{ strtolower(str_replace(' ', '_', $item['role'])) }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteUserModal" title="Hapus">
                                        <i class="lni lni-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- <div class="table-responsive-md rounded-4 shadow-sm">
            <table id="userTable" class="table table-sm table-hover table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 5%">{{ __('No') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Username') }}</th>
                        <th>{{ __('Jenis Kelamin') }}</th>
                        <th>{{ __('Alamat') }}</th>
                        <th>{{ __('Nomor Telepon') }}</th>
                        <th>{{ __('Divisi') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th style="width: 15%">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['model']->name }}</td>
                            <td>{{ $item['model']->email }}</td>
                            <td>{{ $item['model']->username ?? '-' }}</td>
                            <td>{{ $item['model']->gender ?? '-' }}</td>
                            <td>{{ $item['model']->address ?? '-' }}</td>
                            <td>{{ $item['model']->phone_number ?? '-' }}</td>
                            <td>{{ $item['model']->division ?? '-' }}</td>
                            <td>
                                @if ($item['role'] === 'Admin')
                                    <span class="badge bg-info text-dark">{{ __('Admin') }}</span>
                                @elseif ($item['role'] === 'Shift Leader')
                                    <span class="badge bg-warning text-dark">{{ __('Shift Leader') }}</span>
                                @else
                                    <span class="badge bg-success text-white">{{ __('Employee') }}</span>
                                @endif
                            </td>
                            <td class="d-flex flex-wrap justify-content-center gap-2">

                                <a href="{{ route($prefix . '.user.show', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                    class="btn btn-sm btn-info">{{ __('Detail') }}</a>

                                <a href="{{ route($prefix . '.user.edit', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="lni lni-pencil"></i>
                                </a>

                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $item['model']->id }}"
                                    data-role="{{ strtolower(str_replace(' ', '_', $item['role'])) }}"
                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal" title="Hapus">
                                    <i class="lni lni-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="deleteUserForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">{{ __('Hapus Pengguna') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Apakah Anda yakin ingin menghapus user') }} <strong id="deleteUserName"></strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">{{ __('Hapus') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Batal') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#unit-table').DataTable({
                responsive: true,
            });

            $('#ash-fgd-table').DataTable({
                responsive: true,
            });

            $('#wtp-table').DataTable({
                responsive: true,
            });

            $('#deleteUserModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const userId = button.data('id');
                const userRole = button.data('role');
                const userName = button.closest('tr').find('td:nth-child(2)').text();

                $('#deleteUserName').text(userName);

                const url = "{{ route($prefix . '.user.destroy', [':id', ':role']) }}"
                    .replace(':id', userId)
                    .replace(':role', userRole);

                $('#deleteUserForm').attr('action', url);
            });
        });
    </script>
@endpush
