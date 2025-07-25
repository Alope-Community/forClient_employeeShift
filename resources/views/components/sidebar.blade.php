@php
    $languages = [
        ['code' => 'id', 'label' => 'Bahasa Indonesia', 'flag' => '🇮🇩'],
        ['code' => 'en', 'label' => 'English', 'flag' => '🇺🇸'],
        ['code' => 'zh', 'label' => '中文', 'flag' => '🇨🇳'],
    ];
@endphp
@php
    $currentLocale = app()->getLocale();
@endphp

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
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.leave-application.index') ? 'active' : '' }}">
                    <a href="{{ route('employee.leave-application.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Data Pengajuan Pergantian Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.report-problem.index') ? 'active' : '' }}">
                    <a href="{{ route('employee.report-problem.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Data Pengajuan Permasalahan Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.shift-replacement.create') ? 'active' : '' }}">
                    <a href="{{ route('employee.shift-replacement.create') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Pengajuan Backup Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.shift-history.index') ? 'active' : '' }}">
                    <a href="{{ route('employee.shift-history.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Data Riwayat Pergantian Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('employee.report-problem-history') ? 'active' : '' }}">
                    <a href="{{ route('employee.report-problem-history') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Data Riwayat Permasalahan Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item has-submenu">
                    <a href="#" class="sidebar-link submenu-toggle">
                        <i class="lni lni-world"></i>
                        <span>{{ __('Bahasa') }}</span>
                        <i class="lni lni-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('language.switch', 'id') }}" class="sidebar-link">🇮🇩
                                {{ __('Bahasa Indonesia') }}</a></li>
                        <li><a href="{{ route('language.switch', 'en') }}" class="sidebar-link">🇺🇸
                                {{ __('English') }}</a></li>
                        <li><a href="{{ route('language.switch', 'zh') }}" class="sidebar-link">🇨🇳
                                {{ __('中文') }}</a></li>
                    </ul>
                </li>
            @endauth

            @auth('shift_leader')
                <li class="sidebar-item {{ request()->routeIs('leader.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('leader.dashboard') }}" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('shift-leader.user.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.user.index') }}" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>{{ __('Data Pengguna') }}</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('shift-leader.shift.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.shift.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Shift') }}</span>
                    </a>
                </li>

                {{-- <li class="sidebar-item {{ request()->routeIs('shift-leader.schedule.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.schedule.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Jadwal Shift') }}</span>
                    </a>
                </li> --}}

                <li class="sidebar-item {{ request()->routeIs('shift-leader.report-problem.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.report-problem.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Laporan Permasalahan Shift') }}</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('shift-leader.shift-change.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.shift-change.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Verifikasi Pergantian Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item has-submenu">
                    <a href="#" class="sidebar-link submenu-toggle">
                        <i class="lni lni-world"></i>
                        <span>{{ __('Bahasa') }}</span>
                        <i class="lni lni-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('language.switch', 'id') }}" class="sidebar-link">🇮🇩
                                {{ __('Bahasa Indonesia') }}</a></li>
                        <li><a href="{{ route('language.switch', 'en') }}" class="sidebar-link">🇺🇸
                                {{ __('English') }}</a></li>
                        <li><a href="{{ route('language.switch', 'zh') }}" class="sidebar-link">🇨🇳
                                {{ __('中文') }}</a></li>
                    </ul>
                </li>
            @endauth

            @auth('admin')
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>{{ __('Data Pengguna') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.shift.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.shift.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Shift') }}</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item {{ request()->routeIs('admin.schedule.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.schedule.index') }}" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>{{ __('Data Jadwal Shift') }}</span>
                    </a>
                </li> --}}
                <li class="sidebar-item {{ request()->routeIs('admin.leave-application.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.leave-application.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Laporan Pergantian Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('admin.shift-change.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.shift-change.index') }}" class="sidebar-link">
                        <i class="lni lni-clipboard"></i>
                        <span>{{ __('Data Verifikasi Pergantian Shift') }}</span>
                    </a>
                </li>
                <li class="sidebar-item has-submenu">
                    <a href="#" class="sidebar-link submenu-toggle">
                        <i class="lni lni-world"></i>
                        <span>{{ __('Bahasa') }}</span>
                        <i class="lni lni-chevron-down ms-auto"></i>
                    </a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('language.switch', 'id') }}" class="sidebar-link">🇮🇩
                                {{ __('Bahasa Indonesia') }}</a></li>
                        <li><a href="{{ route('language.switch', 'en') }}" class="sidebar-link">🇺🇸
                                {{ __('English') }}</a></li>
                        <li><a href="{{ route('language.switch', 'zh') }}" class="sidebar-link">🇨🇳
                                {{ __('中文') }}</a></li>
                    </ul>
                </li>
            @endauth
        </ul>

        <div class="sidebar-footer">
            @auth('employee')
                <li class="sidebar-item {{ request()->routeIs('employee.profile.index') ? 'active' : '' }}">
                    <a href="{{ route('employee.profile.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>
                </li>
            @endauth

            @auth('shift_leader')
                <li class="sidebar-item {{ request()->routeIs('shift-leader.profile.index') ? 'active' : '' }}">
                    <a href="{{ route('shift-leader.profile.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>
                </li>
            @endauth

            @auth('admin')
                <li class="sidebar-item {{ request()->routeIs('admin.profile.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>{{ __('Profile') }}</span>
                    </a>
                </li>
            @endauth

            @auth('employee')
                <form action="{{ route('employee.logout') }}" method="POST"
                    class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form"
                    style="border: none; background: none;">
                    @csrf
                    <button type="submit"
                        class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button"
                        style="color: inherit; text-decoration: none;">
                        <i class="lni lni-exit fs-5"></i>
                        <span>{{ __('Logout') }}</span>
                    </button>
                </form>
            @endauth

            @auth('shift_leader')
                <form action="{{ route('shift-leader.logout') }}" method="POST"
                    class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form"
                    style="border: none; background: none;">
                    @csrf
                    <button type="submit"
                        class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button"
                        style="color: inherit; text-decoration: none;">
                        <i class="lni lni-exit fs-5"></i>
                        <span>{{ __('Logout') }}</span>
                    </button>
                </form>
            @endauth

            @auth('admin')
                <form action="{{ route('admin.logout') }}" method="POST"
                    class="d-flex align-items-center mx-2 py-2 sidebar-link text-white logout-form"
                    style="border: none; background: none;">
                    @csrf
                    <button type="submit"
                        class="btn btn-link text-start w-100 d-flex align-items-center gap-2 logout-button"
                        style="color: inherit; text-decoration: none;">
                        <i class="lni lni-exit fs-5"></i>
                        <span>{{ __('Logout') }}</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.submenu-toggle');

            toggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();

                    const parentItem = this.closest('.sidebar-item');

                    // Tutup semua dropdown yang lain
                    document.querySelectorAll('.sidebar-item.open').forEach(item => {
                        if (item !== parentItem) {
                            item.classList.remove('open');
                        }
                    });

                    // Toggle yang diklik
                    parentItem.classList.toggle('open');
                });
            });
        });
    </script>
@endpush
