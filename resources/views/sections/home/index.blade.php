@extends('layouts.app')

@section('content')
 <div class="main p-3 ms-3 mt-3">
        <div>
            <h1 class="fs-2 mb-3">Dashboard Admin</h1>
            <h2 class="fs-4 mb-4">Hallo Admin Taufan 👋</h2>
        </div>

        <div class="row g-3">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card shadow-sm" style="border-left: 4px solid red; min-height: 120px;">
                    <div class="card-body d-flex justify-content-between align-items-center h-100">
                        <div>
                            <div class="fw-medium">Admin</div>
                            <div class="fs-4 fw-bold">95</div>
                        </div>
                        <i class="lni lni-user fs-1"></i>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card shadow-sm" style="border-left: 4px solid red; min-height: 120px;">
                    <div class="card-body d-flex justify-content-between align-items-center h-100">
                        <div>
                            <div class="fw-medium">Shift Leader</div>
                            <div class="fs-4 fw-bold">20</div>
                        </div>
                        <i class="lni lni-briefcase fs-1"></i>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card shadow-sm" style="border-left: 4px solid red; min-height: 120px;">
                    <div class="card-body d-flex justify-content-between align-items-center h-100">
                        <div>
                            <div class="fw-medium">Karyawan</div>
                            <div class="fs-4 fw-bold">150</div>
                        </div>
                        <i class="lni lni-users fs-1"></i>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-md-4">
                <div class="card shadow-sm" style="border-left: 4px solid red; min-height: 120px;">
                    <div class="card-body d-flex justify-content-between align-items-center h-100">
                        <div>
                            <div class="fw-medium">Shift</div>
                            <div class="fs-4 fw-bold">25</div>
                        </div>
                        <i class="lni lni-calendar fs-1"></i>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-md-4">
                <div class="card shadow-sm" style="border-left: 4px solid red; min-height: 120px;">
                    <div class="card-body d-flex justify-content-between align-items-center h-100">
                        <div>
                            <div class="fw-medium">Laporan</div>
                            <div class="fs-4 fw-bold">30</div>
                        </div>
                        <!-- Mengganti ikon dengan ikon buku -->
                        <i class="lni lni-books fs-1"></i>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection