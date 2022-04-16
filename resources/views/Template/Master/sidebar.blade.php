<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Perpustakaan Kukuh</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img 
          @if (Auth()->User()->id_gender == 1)
            src="{{ asset('/dist/img/user2-160x160.jpg') }}"
          @else
            src="{{ asset('/dist/img/user4-128x128.jpg') }}"
          @endif
           class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile/{{ Auth()->User()->username }}" class="d-block">{{ Auth()->User()->username }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if (Auth()->User()->id_role === 1)
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ $title !== 'Dashboard' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/students" class="nav-link {{ $title !== 'Students' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/books') }}" class="nav-link {{ $title !== 'Books' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Books</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link {{ $title !== 'Categories' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories & Bookshelf</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/return" class="nav-link {{ $title !== 'Return' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Returning Book</p>
                </a>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Book
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/home" class="nav-link {{ $title !== 'Home' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Books</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/profile/{{ Auth()->User()->username }}" class="nav-link {{ $title !== 'Profile' ? 'none' : 'active' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-header"></li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="fa-solid fa-right-from-bracket"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>