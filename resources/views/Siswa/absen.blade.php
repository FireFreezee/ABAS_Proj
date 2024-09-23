<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--=============== BOXICONS ===============-->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}

    <!--=============== Icon ===============-->
    <link rel="icon" href="{{ asset('assets/img/logo-abas.png') }}" type="image/x-icon" />
    
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/page-siswa2/assets/css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/icon-kit/dist/css/iconkit.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/dist/css/ionicons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/weather-icons/css/weather-icons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/c3/c3.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <title>ABAS - Absen</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <div class="wrapper">
        <header class="header-top" id="header" style="padding-top: 5px; padding-bottom: 5px; padding-left: 12px;">
            <div class="relative -mx-4 flex items-center p-[15px]">
                <div class="grid grid-cols-3 justify-between w-full px-2">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/img/logo-abas.png') }}"
                            class="h-[20px] w-auto md:h-[40px] md:w-auto object-left" alt="lavalite">
                        <img src="{{ asset('assets/img/logo-title.png') }}"
                            class="h-[20px] w-auto md:h-[40px] md:w-auto  sm:w-auto" alt="lavalite">
                    </div>
                    <div class="flex justify-center items-center">
                        <div class="hidden lg:!block" id="nav-menu">
                            <div class="grid grid-cols-2 justify-center gap-2">
                                <a href="{{ route('siswa-dashboard') }}"
                                    class="decoration-transparent items-center group lg:text-sm bg-blue-600 p-[10px] font-semibold text-white rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div class="text-[10px] lg:text-[15px] text-white flex items-center">Dashboard</div>
                                </a>
                                <a href="{{ route('siswa-laporan') }}"
                                    class="decoration-transparent group items-center bg-slate-100 hover:bg-blue-600 font-semibold p-[10px] rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div
                                        class="text-slate-900 text-[10px] lg:text-[15px] group-hover:text-white flex items-center">
                                        Laporan</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-menu flex justify-end items-center pr-2">
                        <div class="dropdown">
                            <a class="" href="#" id="userDropdown" role="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar overflow-hidden !flex !justify-center">
                                    <img class="!bg-white !h-full !max-w-fit"
                                        src="{{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}"
                                        alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('siswa-profile') }}"><i class="ik ik-user dropdown-icon"></i>
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

        <div
            class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 lg:hidden">
            <div class="grid h-full max-w-lg grid-cols-2 mx-auto font-medium">
                <a type="button" href="{{ route('siswa-dashboard') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <span
                        class="text-sm text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Dashboard</span>
                </a>
                <a type="button" href="{{ route('siswa-laporan') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2" />
                    </svg>
                    <span
                        class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Laporan</span>
                </a>
            </div>
        </div>
        <div class="page-wrap">
            <!--=============== HOME ===============-->
            <div class="main-content" style="padding-left: 0px;">
                <input type="hidden" id="lokasi">
                <div class="col-md-12">
                    <div class="container-fluid mb-12">
                        <div class="card ">
                            <a class="flex items-center p-3 text-sm sm:text-lg gap-1" href="javascript:history.back()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-[17px] w-[17px] sm:h-[25px] sm:w-[25px]" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                back
                            </a>
                            <div class="card-header">
                                <h3 class="!text-2xl">Presensi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="ambilfotowrapper !w-[275px] !h-[275px] sm:!w-[600px] sm:!h-[450px]">
                                            <div class="webcam-container !w-[275px] !h-[275px] sm:!w-[600px] sm:!h-[450px]">
                                                <div class="webcam-capture !w-[275px] !h-[275px] sm:!w-[600px] sm:!h-[450px]" id="webcamCapture"></div>
                                                <img id="result" class="foto !w-[275px] !h-[275px] sm:!w-[600px] sm:!h-[450px]" alt="bukti">
                                                <canvas id="faceCanvas"
                                                    style="position: absolute; top: 0; left: 0;"></canvas>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 sm:grid-cols-3  pt-15 mb-3 gap-2">
                                            <div class="">
                                                <button type="button" class="btn-absen btn-primary btn-block text-xs sm:text-lg bg-blue-500"
                                                    id="takeSnapshot"
                                                    style="border-radius: 10px; padding:7px;">
                                                    <i class="ik ik-maximize"></i>&nbsp;Ambil Gambar
                                                </button>
                                            </div>
                                            <div class="">
                                                <button type="button" class="btn-absen btn-primary btn-block text-xs sm:text-lg bg-blue-500"
                                                    id="resetCamera"
                                                    style="border-radius: 10px; padding:7px;">
                                                    <i class="ik ik-maximize"></i>&nbsp;Ulang
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div id="map" class="!h-[300px] sm:!h-[450px] z-10"></div>
                                        <div class="grid grid-cols-2 pt-15">
                                            <div class=""></div>
                                            <div class="">
                                                @if ($cek > 0)
                                                    <button type="button" class="btn-absen btn-danger btn-block text-xs sm:text-lg bg-red-600"
                                                        id="absen"
                                                        style="border-radius: 10px; padding:7px;">
                                                        <i class="ik ik-maximize"></i>&nbsp;Absen Pulang
                                                    </button>
                                                @else
                                                    <button type="button" class="btn-absen btn-primary btn-block text-xs sm:text-lg bg-blue-500"
                                                        id="absen"
                                                        style="border-radius: 10px; padding:7px;">
                                                        <i class="ik ik-maximize"></i>&nbsp;Absen Masuk
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--=============== MAIN JS ===============-->

    <script src="{{ asset('assets/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="{{ asset('assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/screenfull/dist/screenfull.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/d3/dist/d3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/tables.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/charts.js') }}"></script> --}}
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="{{ asset('assets/face-api.js-master/dist/face-api.min.js') }}"></script>
    <script src="{{ asset('assets/js/faceDTC_and_coordinat.js') }}"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        // (function(b, o, i, l, e, r) {
        //     b.GoogleAnalyticsObject = l;
        //     b[l] || (b[l] =
        //         function() {
        //             (b[l].q = b[l].q || []).push(arguments)
        //         });
        //     b[l].l = +new Date;
        //     e = o.createElement(i);
        //     r = o.getElementsByTagName(i)[0];
        //     e.src = 'https://www.google-analytics.com/analytics.js';
        //     r.parentNode.insertBefore(e, r)
        // }(window, document, 'script', 'ga'));
        // ga('create', 'UA-XXXXX-X', 'auto');
        // ga('send', 'pageview');

        // Pass PHP variables to JavaScript
        var lokasiSekolah = @json($lok_sekolah->lokasi_sekolah);
        var radiusSekolah = @json($lok_sekolah->radius);
    </script>

</body>

</html>
