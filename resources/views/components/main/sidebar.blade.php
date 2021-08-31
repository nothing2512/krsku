<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ adminlte(LOGO) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KrsKu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route("dashboard") }}" class="nav-link {{ $menu == TAB_DASHBOARD ? "active" : "" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("semester") }}" class="nav-link {{ $menu == TAB_SEMESTER ? "active" : "" }}">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Semester</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("course") }}" class="nav-link {{ $menu == TAB_COURSE ? "active" : "" }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Course</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("certificate") }}" class="nav-link {{ $menu == TAB_CERTIFICATE ? "active" : "" }}">
                        <i class="nav-icon fas fa-medal"></i>
                        <p>Certificate</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
