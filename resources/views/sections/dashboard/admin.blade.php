<div class="row g-4">
    <!-- Admin -->
    <div class="col-md-4">
        <div class="card card-border-left border-red">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Admin</h5>
                    <p class="fs-4 mb-0">{{ $countAdmins }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Shift Leader -->
    <div class="col-md-4">
        <div class="card card-border-left border-blue">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Shift Leader</h5>
                    <p class="fs-4 mb-0">{{ $countLeaders }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Karyawan -->
    <div class="col-md-4">
        <div class="card card-border-left border-navy">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Karyawan</h5>
                    <p class="fs-4 mb-0">{{ $countEmployees }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Shift -->
    <div class="col-md-6">
        <div class="card card-border-left border-green">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Shift</h5>
                    <p class="fs-4 mb-0">{{ $countShifts }}</p>
                </div>
                <i class="bi bi-clock icon"></i>
            </div>
        </div>
    </div>

    <!-- Laporan -->
    <div class="col-md-6">
        <div class="card card-border-left border-yellow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">Laporan</h5>
                    <p class="fs-4 mb-0">{{ $countReports }}</p>
                </div>
                <i class="bi bi-journal-bookmark-fill icon"></i>
            </div>
        </div>
    </div>

</div>
