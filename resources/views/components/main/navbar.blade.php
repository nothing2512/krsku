<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <h3>Hello, {{ $user->name ?? "" }}</h3>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link p-1 pr-3" data-toggle="dropdown" href="#">
                <div class="image">
                    <img src="{{ adminlte(DEFAULT_PHOTO) }}" style="width: 32px" class="img-circle elevation-2" alt="User Image">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#settings-modal">
                    <i class="fas fa-cog"></i>
                    <span>Setting</span>
                </a>

                <div class="dropdown-divider"></div>
                <a href="{{ route("logout") }}" class="dropdown-item bg-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
    </ul>
</nav>
