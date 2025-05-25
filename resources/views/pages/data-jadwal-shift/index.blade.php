@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col">
            <h3 class="fw-bold mb-4">Jadwal Shift Karyawan <i class="lni lni-calendar"></i></h3>
            <div class="mb-3">
                <a href="" class="btn btn-primary">
                    <i class="lni lni-plus me-1"></i> Tambah Jadwal Shift
                </a>
            </div> 
            <table id="shiftTable" class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Shift</th>
                        <th>Tanggal & Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rizki</td>
                        <td>Shift Pagi (07:00 - 15:00)</td>
                        <td>2025-07-01 07:00</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="lni lni-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alya</td>
                        <td>Shift Siang (15:00 - 23:00)</td>
                        <td>2025-07-01 15:00</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="lni lni-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Dimas</td>
                        <td>Shift Malam (23:00 - 07:00)</td>
                        <td>2025-07-01 23:00</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="lni lni-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Hapus Jadwal Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus jadwal shift ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#shiftTable').DataTable();
    });
</script>
@endsection
