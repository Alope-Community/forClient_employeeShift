@extends('layouts.app')

@section('content')
<div class="main p-3 ms-3 mt-3">
    <div class="row">
        <div class="col">
                <h3 class="fw-bold">Data Shift <i class="lni lni-timer"></i></h3>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
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
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="lni lni-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Shift Malam</td>
                                <td>B</td>
                                <td>16:00</td>
                                <td>00:00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="lni lni-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Shift Dini Hari</td>
                                <td>C</td>
                                <td>00:00</td>
                                <td>08:00</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="lni lni-pencil"></i>
                                    </button>
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
</div>

@endsection