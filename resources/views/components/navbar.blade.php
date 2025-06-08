<nav class="navbar bg-white shadow-sm px-4 sticky-top" style="z-index: 1030;">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('/assets/logo_color.png') }}" alt="Bukit Asam" height="40">
    </a>
    
    <div class="d-flex align-items-center gap-3">
      {{-- Dropdown Login --}}
      <div class="dropdown">
        <button class="btn custom-login-btn dropdown-toggle px-4" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          {{ __('Login') }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
          <li>
            <a class="dropdown-item" href="{{ route('employee.login.view') }}">
              {{ __('Login sebagai Karyawan') }}
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('admin.login.view') }}">
              {{ __('Login sebagai Admin') }}
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="{{ route('leader.dashboard') }}">
              {{ __('Login sebagai Shift Leader') }}
            </a>
          </li>
        </ul>
      </div>

      {{-- Dropdown Bahasa --}}
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          🌐 {{ strtoupper(app()->getLocale()) }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
          <li><a class="dropdown-item" href="{{ route('language.switch', 'id') }}">🇮🇩 Indonesia</a></li>
          <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}">🇺🇸 English</a></li>
          <li><a class="dropdown-item" href="{{ route('language.switch', 'zh') }}">🇨🇳 中文</a></li>
        </ul>
      </div>
    </div>

  </div>
</nav>
