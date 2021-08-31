<!DOCTYPE html>
<html lang="en">
<head>
    <title>KrsKu | @yield("title")</title>
    @include("components.main.header")
</head>
<body class="sidebar-mini h-auto {{ ($collapseSidebar ?? '') ? 'sidebar-collapse' : '' }}">
<div class="wrapper">

    <!-- Preloader -->
    @if($menu == TAB_DASHBOARD)
        @include("components.main.preloader")
    @endif

    <!-- Navbar -->
    @include("components.main.navbar")
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include("components.main.sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @yield("backButton")
                        @if ($hasContentTitle ?? true)
                            <h1 class="m-0">@yield("contentTitle")</h1>
                        @endif
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @yield("content")

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    @include("components.main.footer")

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    @include("components.modal.settings")

    @include("components.main.scripts")
    @if(session()->has("error"))
        @include("components.alert.danger", ["message" => session()->get("error")])
    @endif
    @yield("script")

</body>
</html>
