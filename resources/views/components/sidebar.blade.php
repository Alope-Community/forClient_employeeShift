<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex" style="padding-top: 20px;">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#"><img src="/assets/logo_white.png" alt="" style="width: 150px; "></a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-users"></i>
                    <span>Data User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-protection"></i>
                    <span>Auth</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Login</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Register</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
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



</div>
<script>
    const hamBurger = document.querySelector(" .toggle-btn");

    hamBurger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });
</script>