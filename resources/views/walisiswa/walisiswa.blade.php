<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}

    <!--=============== Icon ===============-->
    <link rel="icon" href="{{ asset('assets/img/logo-abas.png') }}" type="image/x-icon" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/page-siswa2/assets/css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/dist/css/ionicons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.css') }}"> --}}
    {{-- <link rel="stylesheet" --}}
    {{-- href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/weather-icons/css/weather-icons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/c3/c3.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    {{-- <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <title>ABAS - Dashboard</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <div class="wrapper">
        <header class="header-top" id="header" style="padding-top: 5px; padding-bottom: 5px; padding-left: 12px;">
            <div class="relative -mx-4 flex items-center p-[15px]">
                <div class="grid grid-cols-2 justify-between w-full px-2">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/img/logo-abas.png') }}"
                            class="h-[20px] w-auto md:h-[40px] md:w-auto object-left" alt="lavalite">
                        <img src="{{ asset('assets/img/logo-title.png') }}"
                            class="h-[20px] w-auto md:h-[40px] md:w-auto  sm:w-auto" alt="lavalite">
                    </div>
                    <div class="top-menu flex justify-end items-center pr-2">
                        <div class="dropdown">
                            <a class="" href="#" id="userDropdown" role="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img class="avatar" src="{{ asset('assets/img/user.jpg') }}" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i>
                                    Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ik ik-power dropdown-icon"></i> {{ __('Logout') }}
                                </a>
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
            <!--=============== HOME ===============-->
            <div class="main-content" style="padding-left: 0px; padding-right: 0px">
                <input type="hidden" id="lokasi">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-20">
                                <div class="flex justify-center">
                                    <img src="{{ asset('assets/page-siswa2/img/user.jpg') }}" width="150"
                                        class="rounded-circle" alt="user">
                                </div>
                                <h4 class="mt-20 mb-0">{{ Auth::user()->nama }}</h4>
                                <a href="#" style="text-decoration: none">{{ Auth::user()->email }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid" style="margin-left: 0px; margin-right: 0px; max-width: none;">

                </div>
            </div>
        </div>
    </div>
    </div>


    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        // window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/screenfull/dist/screenfull.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"> --}}
    </script>
    {{-- <script src="{{ asset('assets/plugins/d3/dist/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/js/tables.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script> --}}
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets/js/timedate.js') }}"></script>
</body>

</html>
