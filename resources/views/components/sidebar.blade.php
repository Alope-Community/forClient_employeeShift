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
            @auth('employee')
                <li class="sidebar-item">
                    <a href="{{ route('leave-application.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Data Pengajuan Cuti</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Data Riwayat Cuti</span>
                    </a>
                </li>
            @endauth
            @auth('shift_leader')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Shift</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Jadwal Shift</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Riwayat Shift</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Pergantian Shift</span>
                    </a>
                </li>
            @endauth

            {{-- <li class="sidebar-item">
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
            </li> --}}

        </ul>

        <div class="sidebar-footer">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>

    </aside>

    <script>
        const hamBurger = document.querySelector(" .toggle-btn");

        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
