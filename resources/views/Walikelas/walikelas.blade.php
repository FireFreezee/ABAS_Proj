@extends('layouts.header')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reduce the size of the datepicker popup */
        .datepicker-dropdown {
            transform: scale(0.9);
            /* Adjust this value to make the calendar smaller or larger */
            transform-origin: top left;
            /* Ensure the calendar scales from the top-left corner */
        }

        /* Adjust the size of the header (month and year) */
        .datepicker-dropdown .datepicker-switch {
            font-size: 10px !important;
            /* Smaller header text */
            padding: 2px 5px !important;
            /* Smaller padding */
        }

        /* Adjust the size of navigation arrows */
        .datepicker-dropdown .prev,
        .datepicker-dropdown .next {
            font-size: 10px !important;
        }

        /* Adjust the size of day cells */
        .datepicker-dropdown .datepicker-days td,
        .datepicker-dropdown .datepicker-days th {
            width: 15px !important;
            height: 15px !important;
            line-height: 15px !important;
        }

        /* Adjust the size of month and year selection cells */
        .datepicker-dropdown .datepicker-months td,
        .datepicker-dropdown .datepicker-years td {
            width: 25px !important;
            height: 25px !important;
        }

        /* Smaller today and clear buttons */
        .datepicker-dropdown .datepicker-buttons .btn {
            font-size: 8px !important;
            padding: 2px 5px !important;
        }
    </style>
    <header class="header-top" header-theme="light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="top-menu d-flex align-items-center">
                    <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                    <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                </div>
                <div class="top-menu d-flex align-items-center">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="avatar" src="{{ asset('storage/uploads/profile/' . Auth::user()->foto) }}"
                                alt="Foto Profil"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('walikelas-profile') }}"><i
                                    class="ik ik-user dropdown-icon"></i>
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
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ Session::get('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
                }
            });
        </script>
    @endif
    <div class="page-wrap">
        <div class="app-sidebar colored">
            <div class="sidebar-header">
                <a class="header-brand" href="index.html">
                    <div class="flex">
                        <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: auto; width: 2rem;"
                            alt="lavalite">
                        <img src="{{ asset('assets/img/logo-title.png') }}" style="height: 2rem; width: auto;"
                            class="text" alt="lavalite">
                    </div>
                </a>
                <button type="button" class="nav-toggle"><i data-toggle="expanded"
                        class="ik ik-toggle-right toggle-icon"></i></button>
                <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
            </div>

            <div class="sidebar-content">
                <div class="nav-container">
                    <nav id="main-menu-navigation" class="navigation-main">
                        <div class="nav-lavel">Home</div>
                        <div class="nav-item active">
                            <a href="{{ route('walikelas-dashboard') }}"><i
                                    class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                        </div>
                        <div class="nav-lavel">Laporan</div>
                        <div class="nav-item">
                            <a href="{{ route('list-siswa') }}"><i class="ik ik-inbox"></i><span>Laporan
                                    Absensi</span></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <h5 class="font-bold text-[20px] mb-4">
                    Kehadiran Seluruh Siswa Hari Ini
                </h5>
                <div class="grid grid-cols-5 gap-2">
                    <div class="card ">
                        <div class="card-body border-l-8 border-green-500">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h3 class="text-green-500 text-lg">{{ $countHadir }} Siswa</h3>
                                    <p class="card-subtitle text-muted fw-500 text-xl">Hadir</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm2.023 6.828a.75.75 0 1 0-1.06-1.06 3.75 3.75 0 0 1-5.304 0 .75.75 0 0 0-1.06 1.06 5.25 5.25 0 0 0 7.424 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="progress mt-3 mb-1 !h-2 bg-green-200" style="height: 6px;">
                                <div class="progress-bar bg-green-500 " role="progressbar"
                                    style="width: {{ $percentageHadir }}%;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                            <div class="text-muted f12">
                                <span class="float-right">{{ number_format($percentageHadir) }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body border-l-8 border-cyan-500">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h3 class="text-aqua text-lg">{{ $countSakitIzin }} Siswa</h3>
                                    <p class="card-subtitle text-muted fw-500 text-xl">Sakit/Izin</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm-4.34 7.964a.75.75 0 0 1-1.061-1.06 5.236 5.236 0 0 1 3.73-1.538 5.236 5.236 0 0 1 3.695 1.538.75.75 0 1 1-1.061 1.06 3.736 3.736 0 0 0-2.639-1.098 3.736 3.736 0 0 0-2.664 1.098Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="progress mt-3 mb-1 !h-2 bg-cyan-200" style="height: 6px;">
                                <div class="progress-bar bg-aqua" role="progressbar"
                                    style="width: {{ $percentageSakitIzin }}%;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                            <div class="text-muted f12">
                                <span class="float-right">{{ number_format($percentageSakitIzin) }}%</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body border-l-8 border-red-700">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h3 class="text-red-700 text-lg">{{ $countAlfa }} Siswa</h3>
                                    <p class="card-subtitle text-muted fw-500 text-xl">Alfa</p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="progress mt-3 mb-1 !h-2 bg-red-200" style="height: 6px;">
                                <div class="progress-bar bg-red-700" role="progressbar"
                                    style="width: {{ $percentageAlfa }}%;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                            <div class="text-muted f12">
                                <span class="float-right">{{ number_format($percentageAlfa) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-full w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between mb-5">
                        <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Statistik
                                Kehadiran
                            </h5>
                        </div>
                        <form action="{{ route('walikelas-dashboard') }}" method="GET">
                            <div id="date-range-picker" class="flex flex-wrap items-center gap-4 pb-2">
                                <div class="relative w-full sm:w-auto flex-1">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500 dark:text-gray-400"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-start" datepicker datepicker-format="yyyy-mm-dd"
                                        name="start" type="text"
                                        class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-[10px] sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Select date start" value="{{ $startDate }}">
                                </div>

                                <span class="text-gray-500 dark:text-gray-400">to</span>

                                <div class="relative w-full sm:w-auto flex-1">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500 dark:text-gray-400"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="datepicker-range-end" datepicker datepicker-format="yyyy-mm-dd"
                                        name="end" type="text"
                                        class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-[10px] sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Select date end" value="{{ $endDate }}">
                                </div>

                                <button type="submit"
                                    class="bg-blue-500 text-white h-8 p-2 rounded-lg w-full sm:w-auto hover:bg-blue-800">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="legend-chart" class="!my-4"></div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script>
            var chartStatusCount = @json($chartStatusCount);
        </script>
    @endsection
