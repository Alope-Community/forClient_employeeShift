@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <h3 class="fw-bold">Data User <i class="lni lni-users"></i></h3>
    <div class="mb-3">
        <a href="#" class="btn btn-primary">
            <i class="lni lni-plus"></i> Tambah User
        </a>
    </div>

    <div class="table-responsive">
        <table id="userTable" class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr>
                    <td>1</td>
                    <td>Rizki</td>
                    <td>rizki01</td>
                    <td>Admin</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-sm btn-outline-primary me-1" title="Edit"
                            data-bs-toggle="modal" data-bs-target="#editUserModal"
                            data-nama="Rizki"
                            data-email="rizki01"
                            data-role="Admin"
                        >
                            <i class="lni lni-pencil"></i>
                        </button>

                        <!-- Tombol Hapus -->
                        <button class="btn btn-sm btn-outline-danger" title="Hapus"
                            data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                            data-nama="Rizki"
                        >
                            <i class="lni lni-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus User -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteUserForm" method="POST" action="javascript:void(0);">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteUserModalLabel">Hapus User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus user <strong id="deleteUserName"></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#userTable').DataTable({
            responsive: true,
            autoWidth: false
        });

        // Isi data di modal Hapus saat tombol hapus diklik
        $('#deleteUserModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const nama = button.data('nama');

            const modal = $(this);
            modal.find('#deleteUserName').text(nama);
        });
    });
</script>
@endpush
