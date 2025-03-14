<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </form>
    <ul class="navbar-nav navbar-right">

      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" style="width: 40px;height: 40px;
        object-fit: cover;" src="{{asset(auth()->user()->image)}}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Xin chào, {{auth()->user()->name}}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="{{route('admin.profile')}}" class="dropdown-item has-icon">
            <i class="far fa-user"></i> Trang cá nhân
          </a>

          <a href="{{route('admin.settings.index')}}" class="dropdown-item has-icon">
            <i class="fas fa-cog"></i> Cài đặt
          </a>
          <div class="dropdown-divider"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault();
                this.closest('form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </form>
        </div>
      </li>
    </ul>
  </nav>
