@extends('layouts.app')

@section('content')
    <div class="main p-4">
        <h3 class="fw-bold mb-3"><i class="lni lni-users"></i> Manajemen Pengguna</h3>
        <a href="{{ route('user.create') }}" class="btn btn-primary mb-4">
            <i class="lni lni-plus"></i> Tambah Pengguna
        </a>

        <div class="table-responsive rounded-4 shadow-sm">
            <table id="userTable" class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['model']->name }}</td>
                            <td>{{ $item['model']->email }}</td>
                            <td>
                                @if ($item['role'] === 'Admin')
                                    <span class="badge bg-info text-dark">Admin</span>
                                @elseif ($item['role'] === 'Shift Leader')
                                    <span class="badge bg-warning text-dark">Shift Leader</span>
                                @else
                                    <span class="badge bg-success text-white">Employee</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.show', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                    class="btn btn-sm btn-info">Detail</a>

                                <a href="{{ route('user.edit', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                    class="btn btn-sm btn-secondary">Edit</a>

                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $item['model']->id }}"
                                    data-role="{{ strtolower(str_replace(' ', '_', $item['role'])) }}" title="Hapus"
                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                    <i class="lni lni-trash"></i>
                                </button>

                                {{-- <form
                                    action="{{ route('user.destroy', ['id' => $item['model']->id, 'role' => strtolower(str_replace(' ', '_', $item['role']))]) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Hapus User -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content rounded-4">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteUserModalLabel"><i class="lni lni-trash-can"></i> Hapus User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Yakin ingin menghapus user <strong id="deleteUserName"></strong>?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-danger px-4">Hapus</button>
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                responsive: true,
                autoWidth: false
            });

            // Modal hapus user
            $('#deleteUserModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const userId = button.data('id');
                const userRole = button.data('role');
                const userName = button.closest('tr').find('td:nth-child(2)')
                    .text(); // Ambil nama user dari kolom 2

                // Update teks konfirmasi
                $(this).find('#deleteUserName').text(userName);

                // Update form action dengan route yang benar
                const url = "{{ route('user.destroy', [':id', ':role']) }}"
                    .replace(':id', userId)
                    .replace(':role', userRole);

                $('#deleteUserForm').attr('action', url);
            });
        });
    </script>
@endpush
