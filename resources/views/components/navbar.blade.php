<nav class="navbar bg-white shadow-sm px-4 sticky-top" style="z-index: 1030;">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('/assets/logo_color.png') }}" alt="Bukit Asam" height="40">
    </a>
    <div class="dropdown d-flex align-items-center">
      <button class="btn custom-login-btn dropdown-toggle px-4" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Login
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
      </ul>
    </div>
  </div>
</nav>
