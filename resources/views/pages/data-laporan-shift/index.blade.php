@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
   <div class="row">
        <div class="col">
            <h3 class="fw-bold mb-4">Laporan Pergantian Shift <i class="lni lni-agenda"></i></h3>
            <div class="mb-3">
                <a href="" class="btn btn-primary">
                    <i class="lni lni-plus me-1"></i> Tambah Laporan
                </a>
            </div>    

            <table id="laporanTable" class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Dari Shift</th>
                        <th>Ke Shift</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                        <th>Alamat</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rizki</td>
                        <td>Shift Pagi</td>
                        <td>Shift Malam</td>
                        <td>Penggantian Shift Mendadak</td>
                        <td class="text-start text-wrap" style="min-width: 150px;">Karyawan mengganti shift karena keperluan keluarga.</td>
                        <td>2025-06-21 08:00</td>
                        <td class="text-start text-wrap" style="min-width: 150px;">Jl. Merdeka No. 12</td>
                        <td>
                            <img src="{{ asset('storage/images/sample.jpg') }}" alt="gambar" class="img-fluid rounded" style="width: 80px; height: auto;">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editLaporanModal" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteLaporanModal" title="Hapus">
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
<div class="modal fade" id="deleteLaporanModal" tabindex="-1" aria-labelledby="deleteLaporanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteLaporanForm" action="javascript:void(0);">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteLaporanLabel">Hapus Laporan Pergantian Shift</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data ini?</p>
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

<script>
  $(document).ready(function () {
    $('#laporanTable').DataTable({
      "order": [[0, "asc"]],
      "lengthMenu": [5, 10, 25, 50],
      "pageLength": 5,
      "columnDefs": [
        { "orderable": false, "targets": [8,9] } // gambar & aksi tidak bisa di-sort
      ]
    });
  });
</script>
