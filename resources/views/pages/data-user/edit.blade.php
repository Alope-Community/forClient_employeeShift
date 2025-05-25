@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')
<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editUserForm" method="POST" action="javascript:void(0);">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="editUserName" class="form-label">Nama</label>
                <input type="text" class="form-control" id="editUserName" required>
            </div>

            <div class="mb-3">
                <label for="editUserEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editUserEmail" required>
            </div>

            <div class="mb-3">
                <label for="editUserRole" class="form-label">Role</label>
                <select class="form-select" id="editUserRole" required>
                    <option value="Admin">Admin</option>
                    <option value="User">User</option>
                    <option value="Guest">Guest</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection