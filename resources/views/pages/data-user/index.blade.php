@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col">
            <h3 class="fw-bold">Data User <i class="lni lni-users"></i></h3>

            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>ID Pegawai</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>1</td>
                            <td>123456</td>
                            <td>Rizki</td>
                            <td>rizki01</td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="lni lni-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="lni lni-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Tambahkan baris lainnya jika perlu -->
                    </tbody>
                </table>
            </div>
        </div>
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
    });
</script>
@endpush
