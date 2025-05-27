<div class="wrapper">
    <aside id="sidebar" class="expand">
        <div class="d-flex" style="padding-top: 20px;">
            <button class="toggle-btn" type="button">
                <i class="lni lni-menu"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#"><img src="/assets/logo_white.png" alt="" style="width: 150px;"></a>
            </div>
        </div>

        <ul class="sidebar-nav">
            @auth('employee')
                <li class="sidebar-item {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('employee.dashboard') }}" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.leave-application.index') ? 'active' : '' }}">
                    <a href="{{ route('employee.leave-application.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Data Pengajuan Cuti</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.leave-history') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Data Riwayat Cuti</span>
                    </a>
                </li>
            @endauth

            @auth('shift_leader')
                <li class="sidebar-item {{ request()->routeIs('leader.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('leader.dashboard') }}" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('shift-leader.shift.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.shift.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Shift</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('shift-leader.schedule.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.schedule.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Jadwal Shift</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('shift-leader.shift-change.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.shift-change.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Verifikasi Pergantian Shift</span>
                    </a>
                </li>
            @endauth

            @auth('admin')
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('data.user.index') ? 'active' : '' }}">
                    <a href="{{ route('data.user.index') }}" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Data Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.shift.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.shift.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Shift</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.schedule.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.schedule.index') }}" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>Data Jadwal Shift</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.leave-application.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.leave-application.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Laporan Pergantian Shift</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.shift-change.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.shift-change.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>Data Verifikasi Pergantian Shift</span>
                    </a>
                </li>
            @endauth
        </ul>

        <div class="sidebar-footer">
            @auth('employee')
            <li class="sidebar-item {{ request()->routeIs('employee.profile.index') ? 'active' : '' }}">
                <a href="{{ route('employee.profile.index') }}" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            @endauth

            @auth('shift_leader')
            <li class="sidebar-item {{ request()->routeIs('shift-leader.profile.index') ? 'active' : '' }}">
                <a href="{{ route('shift-leader.profile.index') }}" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            @endauth

            @auth('admin')
            <li class="sidebar-item {{ request()->routeIs('admin.profile.index') ? 'active' : '' }}">
                <a href="{{ route('admin.profile.index') }}" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            @endauth

            @auth('employee')
            <form action="{{ route('employee.logout') }}" method="POST" class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form" style="border: none; background: none;">
                @csrf
                <button type="submit" class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button" style="color: inherit; text-decoration: none;">
                    <i class="lni lni-exit fs-5"></i>
                    <span>Logout</span>
                </button>
            </form>
            @endauth

            @auth('shift_leader')
            <form action="{{ route('shift-leader.logout') }}" method="POST" class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form" style="border: none; background: none;">
                @csrf
                <button type="submit" class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button" style="color: inherit; text-decoration: none;">
                    <i class="lni lni-exit fs-5"></i>
                    <span>Logout</span>
                </button>
            </form>
            @endauth

            @auth('admin')
            <form action="{{ route('admin.logout') }}" method="POST" class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form" style="border: none; background: none;">
                @csrf
                <button type="submit" class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button" style="color: inherit; text-decoration: none;">
                    <i class="lni lni-exit fs-5"></i>
                    <span>Logout</span>
                </button>
            </form>
            @endauth
        </div>

    </aside>
</div>

@push('scripts')
<script>
    const hamBurger = document.querySelector(".toggle-btn");

    hamBurger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });
</script>
@endpush
