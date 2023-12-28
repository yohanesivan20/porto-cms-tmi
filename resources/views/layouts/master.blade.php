<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DUPLICATE | CMS VANGROSIR</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
        {{-- Select2css --}}
        <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/select2.min.css')}}">
        <link rel='stylesheet' href="{{asset('sweet-alert/css/sweetalert2.min.css')}}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <!-- Auth user name -->
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href=""
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-secondary elevation-4">
                <div class="sidebar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link"></a>
                        </li>
                    </ul>

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

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item active">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>DATA PRODUK</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li>
                                        <a class="nav-link" href="{{route('monitoring_product')}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Master Produk</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{route('edit_product')}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Edit Data Produk</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>LAIN-LAIN</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li>
                                        <a class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Monitoring Barcode</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pengajuan DPC</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </aside>

            <div class="content-wrapper">
                <div class="container-fluid">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    
    <!-- jQuery -->
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('AdminLTE/dist/js/alert.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


    <!-- DataTables  & Plugins -->
    <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/bootstrap-toggle.min.js')}}"></script> -->
    <script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('sweet-alert/js/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('sweet-alert/js/sweetalert2@11.js')}}"></script>
    </body>
</html>
