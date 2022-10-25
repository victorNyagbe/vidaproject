<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light sidebar-bg elevation-4">
    <!-- Brand Logo -->
    <div class="brand-block mb-3 d-flex">
      <div href="index3.html" class="brand-link image">
        <img src="{{ asset('assets/logos/goproject-03.jpg') }}" alt="goproject Logo" class="brand-image goproject-logo" style="opacity: .8; width:140px; height:120px;">
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info info-user">
          <a href="#" class="d-block">{{ session()->get('fullname') }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $page == 'admin.dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Tableau de bord
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.project.project') }}" class="nav-link {{ $page == 'admin.project' ? 'active' : '' }}">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Projets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.client') }}" class="nav-link {{ $page == 'admin.client' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                 Client
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.charts') }}" class="nav-link {{ $page == 'admin.charts' ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                 Diagrammes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.calendar') }}" class="nav-link {{ $page == 'admin.calendar' ? 'active' : '' }}">
              <i class="nav-icon bi bi-calendar-date-fill pl-1"></i>
              <p>
                Calendrier
                <span class="badge badge-primary badge-background right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.collaborateur') }}" class="nav-link {{ $page == 'admin.collaborateur' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                 Collaborateurs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.gallery') }}" class="nav-link {{ $page == 'admin.gallery' ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallerie
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.email.mail') }}" class="nav-link {{ $page == 'admin.email' ? 'active' : '' }}">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Boite Mail
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.message.chat') }}" class="nav-link {{ $page == 'admin.message' ? 'active' : '' }}">
              <i class="nav-icon far fa-comments"></i>
              <p>
                Messages
                <span class="badge badge-primary badge-background right">3</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>