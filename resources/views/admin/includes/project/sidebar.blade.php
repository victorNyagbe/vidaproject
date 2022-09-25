<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light sidebar-bg elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('styles/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GoProject</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=" {{ asset('assets/logos/gozem.png') }} " class="img-circle logo-img elevation-2" alt="User Image">
        </div>
        <div class="info info-user">
          <a href="#" class="d-block">Gozem</a>
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
            <a href="{{ route('admin.project.showBord') }}" class="nav-link {{ $page == 'admin.projectBoard.project.showBoard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Tableau de bord
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.board') }}" class="nav-link {{ $page == 'admin.projectBoard.board' ? 'active' : '' }}">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Bureau
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.collaborateur') }}" class="nav-link {{ $page == 'admin.projectBoard.collaborateur' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                 Collaborateurs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.charts') }}" class="nav-link {{ $page == 'admin.projectBoard.charts' ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                 Diagrammes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.calendar') }}" class="nav-link {{ $page == 'admin.projectBoard.calendar' ? 'active' : '' }}">
              <i class="nav-icon bi bi-calendar-date-fill pl-1"></i>
              <p>
                Calendrier
                <span class="badge badge-primary badge-background right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.gallery') }}" class="nav-link {{ $page == 'admin.projectBoard.gallery' ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallerie
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Boite Mail
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.message.chat') }}" class="nav-link {{ $page == 'admin.projectBoard.message' ? 'active' : '' }}">
              <i class="nav-icon far fa-comments"></i>
              <p>
                Messages
                <span class="badge badge-primary badge-background right">3</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.project.project') }}" class="nav-link {{ $page == 'admin.projectBoard.project' ? 'active' : '' }}">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Autres projets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.projectBoard.rapport') }}" class="nav-link {{ $page == 'admin.projectBoard.rapport' ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Rapport
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>