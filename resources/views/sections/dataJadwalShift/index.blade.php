@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col">
            <h3 class="fw-bold mb-4">Jadwal Shift Karyawan <i class="lni lni-calendar"></i></h3>

            <table class="table table-bordered table-striped text-center align-middle">
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
                            <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
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
                            <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
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
                            <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                <i class="lni lni-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection    