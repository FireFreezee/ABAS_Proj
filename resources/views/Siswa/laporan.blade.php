<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--=============== BOXICONS ===============-->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">

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
    {{-- <link rel="stylesheet" --}}
    {{-- href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/weather-icons/css/weather-icons.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/c3/c3.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <title>ABAS - Laporan</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <div class="wrapper">
        <header class="header-top" id="header" style="padding-top: 5px; padding-bottom: 5px; padding-left: 12px;">
            <div class="relative -mx-4 flex items-center p-[15px] pr-[20px]">
                <div class="grid grid-cols-3 justify-between w-full px-2">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/img/logo-abas.png') }}"
                            class="h-[20px] w-auto md:h-[40px] md:w-auto object-left" alt="lavalite">
                        <img src="{{ asset('assets/img/logo-title.png') }}"
                            class="h-[20px] w-auto  md:h-[40px] md:w-auto sm:h-[6px] sm:w-auto" alt="lavalite">
                    </div>

                    <div class="flex justify-center items-center" id="nav-menu">
                        <div class="hidden lg:!block" id="nav-menu">
                            <div class=" grid grid-cols-2 justify-center gap-2">
                                <a href="{{ route('siswa-dashboard') }}"
                                    class="decoration-transparent items-center group md:text-sm bg-slate-100 hover:bg-blue-600 p-[10px] font-semibold text-white rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div
                                        class="text-slate-900 text-[10px] lg:text-[15px] group-hover:text-white flex items-center">
                                        Absen</div>
                                </a>
                                <a href="{{ route('siswa-laporan') }}"
                                    class="decoration-transparent group items-center bg-blue-600 font-semibold p-[10px] rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div class=" text-[10px] lg:text-[15px] text-white flex items-center">Laporan</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-menu flex justify-end items-center pr-2">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                    src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
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
            <!-- <img src="assets/img/perfil.png" alt="" class="nav__img"> -->
        </header>
        <div
            class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 lg:hidden">
            <div class="grid h-full max-w-lg grid-cols-2 mx-auto font-medium">
                <a type="button" href="{{ route('siswa-dashboard') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <span
                        class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Absen</span>
                </a>
                <a type="button" href="{{ route('siswa-laporan') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2" />
                    </svg>
                    <span
                        class="text-sm text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Laporan</span>
                </a>
            </div>
        </div>

        <div class="page-wrap">
            <!--=============== HOME ===============-->
            <div class="main-content" style="padding-left: 0px; padding-right: 0px">
                <div class="container-fluid" style="margin-left: 0px; margin-right: 0px; max-width: none;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header d-block py-24">
                                    <h3 class="py-2.5">Jumlah</h3>
                                </div>
                                <div class="grid grid-rows-6 gap-2 p-4">

                                    <!-- Hadir -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="stroke-green-500 h-[30px] w-[30px]" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        Hadir : {{ $statusCounts['Hadir'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['Hadir'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-green-500" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['Hadir'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['Hadir'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-hadir" type="checkbox" value="Hadir"
                                            data-status="Hadir"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                    <!-- Sakit -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[30px] w-[30px]"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        style="fill: #06b6d4;transform: ;msFilter:;">
                                                        <path
                                                            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                                                        </path>
                                                        <circle cx="8.5" cy="10.5" r="1.5"></circle>
                                                        <circle cx="15.493" cy="10.493" r="1.493"></circle>
                                                        <path d="M12 14c-3 0-4 3-4 3h8s-1-3-4-3z"></path>
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        Sakit : {{ $statusCounts['Sakit'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['Sakit'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-cyan-500" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['Sakit'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['Sakit'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-sakit" type="checkbox" value="Sakit"
                                            data-status="Sakit"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                    <!-- Izin -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <!-- SVG for Izin -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="stroke-orange-400 h-[30px] w-[30px]" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        Izin : {{ $statusCounts['Izin'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['Izin'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-orange-400" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['Izin'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['Izin'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-izin" type="checkbox" value="Izin"
                                            data-status="Izin"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                    <!-- Terlambat -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="stroke-gray-700 h-[30px] w-[30px]" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        Terlambat : {{ $statusCounts['Terlambat'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['Terlambat'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-gray-700" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['Terlambat'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['Terlambat'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-terlambat" type="checkbox" value="Terlambat"
                                            data-status="Terlambat"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                    <!-- Alfa -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="stroke-red-700 h-[30px] w-[30px]" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        Alfa : {{ $statusCounts['Alfa'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['Alfa'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-red-700" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['Alfa'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['Alfa'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-alfa" type="checkbox" value="Alfa"
                                            data-status="Alfa"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                    <!-- TAP -->
                                    <div class="flex items-center">
                                        <div class="bg-slate-100 rounded-xl h-auto w-full p-2">
                                            <div class="flex justify-between">
                                                <div class="flex">
                                                    <!-- SVG for TAP -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-[30px] w-[30px] stroke-red-700" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <!-- Path for TAP icon -->
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="...">
                                                        </path>
                                                    </svg>
                                                    <div
                                                        class="text-dark-3 font-semibold text-base place-content-center">
                                                        TAP : {{ $statusCounts['TAP'] ?? 0 }}x
                                                    </div>
                                                </div>
                                                <div class="text-dark-3 font-semibold text-base">
                                                    {{ number_format($statusPercentages['TAP'] ?? 0) }}%</div>
                                            </div>
                                            <div class="w-full">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-red-700" role="progressbar"
                                                        style="width: {{ number_format($statusPercentages['TAP'] ?? 0) }}%"
                                                        aria-valuenow="{{ number_format($statusPercentages['TAP'] ?? 0) }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="checked-checkbox-tap" type="checkbox" value="TAP"
                                            data-status="TAP"
                                            class="status-checkbox w-6 h-6 mx-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="flex flex-wrap justify-between w-full gap-3">
                                        <h3 class="text-xs!">Detail Laporan</h3>

                                        <form method="GET" action="{{ route('siswa-laporan') }}">
                                            <div id="date-range-picker" class="flex items-center">
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                        </svg>
                                                    </div>
                                                    <input id="datepicker-range-start" datepicker
                                                        datepicker-format="yyyy-mm-dd" name="start" type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Select date start"
                                                        value="{{ request('start') }}">
                                                </div>
                                                <span class="mx-4 text-gray-500">to</span>
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                        </svg>
                                                    </div>
                                                    <input id="datepicker-range-end" datepicker
                                                        datepicker-format="yyyy-mm-dd" name="end" type="text"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Select date end" value="{{ request('end') }}">
                                                </div>
                                                <button type="submit"
                                                    class="bg-blue-500 text-white p-2 rounded-lg ml-4 hover:bg-blue-800">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if ($absensiPaginated->isEmpty() && !$startDate && !$endDate)
                                    <p>Please select a date range to view attendance records.</p>
                                @elseif($absensiPaginated->isEmpty())
                                    <p>No attendance records found for the selected date range.</p>
                                @else
                                    <div class="table-responsive mt-4">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Detail Kehadiran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensiPaginated as $absen)
                                                    <tr id="row-{{ $absen->id_absensi }}"
                                                        class="status-row {{ $absen->status }}">
                                                        <td>{{ $absen->date }}</td>
                                                        <td>{{ $absen->status }}</td>
                                                        <td>
                                                            <button
                                                                data-modal-target="crud-modal-{{ $absen->id_absensi }}"
                                                                data-modal-toggle="crud-modal-{{ $absen->id_absensi }}"
                                                                class="bg-blue-500 h-fit w-[70px] rounded-full p-1 hover:bg-blue-800 hover:text-white">
                                                                Detail
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal for each record -->
                                                    <div id="crud-modal-{{ $absen->id_absensi }}" tabindex="-1"
                                                        aria-hidden="true"
                                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                                            <div
                                                                class="relative bg-white rounded-lg shadow dark:bg-gray-700 px-7 pb-7">
                                                                <div
                                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                    <h3
                                                                        class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                        Detail Absen</h3>
                                                                    <button type="button"
                                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                        data-modal-toggle="crud-modal-{{ $absen->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="2"
                                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <div class="pt-3">
                                                                    <p><strong>Status:</strong> {{ $absen->status }}
                                                                    </p>
                                                                    <p><strong>Date:</strong> {{ $absen->date }}</p>
                                                                    <p><strong>Jam Masuk:</strong>
                                                                        {{ $absen->jam_masuk }}</p>
                                                                    <p><strong>Jam Pulang:</strong>
                                                                        {{ $absen->jam_pulang }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination flex justify-end p-3 text-lg">
                                            {{ $absensiPaginated->links('vendor.pagination.bootstrap-5') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--=============== MAIN JS ===============-->
    <i class="fa fa-xingx" aria-hidden="true"></i>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="{{ asset('assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/screenfull/dist/screenfull.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/d3/dist/d3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/tables.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/widgets.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/charts.js') }}"></script> --}}
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.status-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterTable);
            });

            function filterTable() {
                const selectedStatuses = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                document.querySelectorAll('.status-row').forEach(row => {
                    const status = row.classList[1];
                    if (selectedStatuses.length === 0 || selectedStatuses.includes(status)) {
                        row.style.display = ''; // Show row
                    } else {
                        row.style.display = 'none'; // Hide row
                    }
                });
            }
        });
    </script>
</body>

</html>
