<nav class="navbar navbar-expand-md navbar-light d-none del-d-md-flex" id="topbar">
  <div class="container-fluid">
    <!-- Form -->
    <form class="form-inline me-4 d-none d-md-flex">
      <div class="input-group input-group-flush input-group-merge input-group-reverse">
        <input type="search" class="form-control dropdown-toggle list-search disabled" disabled placeholder="Search not available">
        <div class="input-group-text"><i class="fe fe-search"></i></div>
      </div>
    </form>

    <!-- User -->
    <div class="navbar-user">
      <!-- Notify Dropdown -->
      <div class="me-4 d-none d-md-flex">
        <a href="#" class="navbar-user-link" data-bs-toggle="tooltip" data-bs-placement="bottom" title="not available">
          <span class="icon active"><i class="fe fe-bell"></i></span>
        </a>
      </div>

      <!-- User Dropdown -->
      <div class="dropdown">
        <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" data-bs-toggle="dropdown">
          <img src="{{ asset('images/heycommunity/logo.png') }}" class="avatar-img rounded-circle">
        </a>

        <div class="dropdown-menu dropdown-menu-end">
          <a href="#" class="disabled dropdown-item">Profile</a>
          <a href="#" class="disabled dropdown-item">Settings</a>
          <hr class="dropdown-divider">
          <a href="#" class="disabled dropdown-item">Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>

