@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col">
            <h3 class="fw-bold">Data Shift <i class="lni lni-timer"></i></h3>
            <div class="mb-3">
                <a href="#" class="btn btn-primary">
                    <i class="lni lni-plus"></i> Tambah Shift
                </a>
            </div>

            <div class="table-responsive">
                <table id="shiftTable" class="table table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Shift</th>
                            <th>Grup Shift</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>1</td>
                            <td>Shift Pagi</td>
                            <td>A</td>
                            <td>08:00</td>
                            <td>16:00</td>
                            <td>
                                <button 
                                  class="btn btn-sm btn-outline-primary me-1" 
                                  title="Edit" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#editShiftModal">
                                    <i class="lni lni-pencil"></i>
                                </button>
                                <button 
                                  class="btn btn-sm btn-outline-danger" 
                                  title="Hapus" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#deleteUserModal">
                                    <i class="lni lni-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Baris lain sama -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="#">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteUserModalLabel">Hapus Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data shift ini?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
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
        $('#shiftTable').DataTable({
            responsive: true,
            autoWidth: false,
            columnDefs: [
                { orderable: false, targets: 5 } // Disable ordering pada kolom aksi
            ]
        });
    });
</script>
@endpush
