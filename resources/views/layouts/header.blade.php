<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ABAS - Absensin Sebelas Operator</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('assets/img/logo-abas.png') }}" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i
                                class="ik ik-maximize"></i></button>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                    src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i>
                                    Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"><i
                                        class="ik ik-power dropdown-icon"></i>
                                    {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            @yield('content')

            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2018 ThemeKit v2.0. All Rights
                        Reserved.</span>
                    <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i
                            class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark"
                            target="_blank">Lavalite</a></span>
                </div>
            </footer>

        </div>
    </div>




    <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog"
        aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                class="ik ik-x-circle"></i></button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="quick-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                                <div class="input-wrap">
                                    <input type="text" id="quick-search" class="form-control"
                                        placeholder="Search..." />
                                    <i class="ik ik-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container">
                        <div class="apps-wrap">
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="app-item dropdown">
                                <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="ik ik-command"></i><span>Ui</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/screenfull/dist/screenfull.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/d3/dist/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/js/tables.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>
