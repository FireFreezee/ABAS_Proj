@extends('layouts.header')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
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
                            <a class="dropdown-item" href="{{ route('kesiswaan-profile') }}"><i
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
                        <div class="nav-item">
                            <a href="{{ route('kesiswaan.index') }}"><i
                                    class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                        </div>
                        <div class="nav-lavel">Laporan</div>
                        <div class="nav-item active">
                            <a href="{{ route('kesiswaan.kelas') }}"><i class="ik ik-inbox"></i><span>Laporan
                                    Absensi</span></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <h5 class="font-bold text-[20px] mb-4">
                    Laporan Absensi
                </h5>
                <div class="grid grid-cols-2">
                    <div></div>
                    <form action="{{ route('kesiswaan.kelas') }}" method="GET">
                        <div id="date-range-picker" class="flex justify-end items-center gap-4 pb-2">
                            <div class="relative w-full sm:w-auto flex-1">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-range-start" datepicker datepicker-format="yyyy-mm-dd" name="start"
                                    type="text"
                                    class="bg-gray-50 border h-8 border-gray-300 text-gray-900 text-[10px] sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date start" value="{{ $startDate }}">
                            </div>

                            <span class="text-gray-500 dark:text-gray-400">to</span>

                            <div class="relative w-full sm:w-auto flex-1">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-range-end" datepicker datepicker-format="yyyy-mm-dd" name="end"
                                    type="text"
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
                <div class="p-3 bg-white shadow-lg rounded-lg mt-3">
                    <h5 class="font-bold text-[20px] mb-4">
                        Rata-Rata Kehadiran Seluruh Kelas
                    </h5>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="card">
                            <div class="card-body border-l-8 border-green-500">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="state">
                                        <h3 class="text-green-500 text-lg">
                                            {{ $summaryCounts['totalHadir'] }}x</h3>
                                        <p class="card-subtitle text-muted fw-500 text-xl">
                                            Hadir</p>
                                    </div>
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm2.023 6.828a.75.75 0 1 0-1.06-1.06 3.75 3.75 0 0 1-5.304 0 .75.75 0 0 0-1.06 1.06 5.25 5.25 0 0 0 7.424 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="progress mt-3 mb-1 !h-2 bg-green-200"
                                    style="height: 6px;">
                                    <div class="progress-bar bg-green-500 " role="progressbar"
                                        style="width: {{ $averagePercentageHadir }}%;"
                                        aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-muted f12">
                                    <span
                                        class="float-right">{{ number_format($averagePercentageHadir, 2) }}%</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body border-l-8 border-cyan-500">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="state">
                                        <h3 class="text-aqua text-lg">
                                            {{ $summaryCounts['totalSakitIzin'] }}x</h3>
                                        <p class="card-subtitle text-muted fw-500 text-xl">
                                            Sakit/Izin</p>
                                    </div>
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm-4.34 7.964a.75.75 0 0 1-1.061-1.06 5.236 5.236 0 0 1 3.73-1.538 5.236 5.236 0 0 1 3.695 1.538.75.75 0 1 1-1.061 1.06 3.736 3.736 0 0 0-2.639-1.098 3.736 3.736 0 0 0-2.664 1.098Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="progress mt-3 mb-1 !h-2 bg-cyan-200"
                                    style="height: 6px;">
                                    <div class="progress-bar bg-aqua" role="progressbar"
                                        style="width: {{ $averagePercentageSakitIzin }}%;"
                                        aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-muted f12">
                                    <span
                                        class="float-right">{{ number_format($averagePercentageSakitIzin, 2) }}%</span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body border-l-8 border-red-700">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="state">
                                        <h3 class="text-red-700 text-lg">
                                            {{ $summaryCounts['totalAlfa'] }}x</h3>
                                        <p class="card-subtitle text-muted fw-500 text-xl">Alfa
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="progress mt-3 mb-1 !h-2 bg-red-200"
                                    style="height: 6px;">
                                    <div class="progress-bar bg-red-700" role="progressbar"
                                        style="width: {{ $averagePercentageAlfa }}%;"
                                        aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                                <div class="text-muted f12">
                                    <span
                                        class="float-right">{{ number_format($averagePercentageAlfa, 2) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 mb-1 !h-9 bg-green-200" style="height: 6px;">
                        <div class="progress-bar bg-green-500" role="progressbar"
                            style="width: {{ $averagePercentageHadir }}%;" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100">
                            <div class="text-lg">Hadir {{ number_format($averagePercentageHadir, 2) }}%</div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 bg-gradient-to-t from-[#F6F7FB] from-10% to-white p-3 to-90% rounded-3xl ">
                    <div class="flex justify-between items-center">
                        <h5 class="font-bold text-[20px]">
                            Kelas
                        </h5>
                        <form class="max-w-lg flex gap-3" method="GET" action="{{ route('kesiswaan.kelas') }}">
                            <select name="tingkat" id="tingkat"
                                class="block w-32 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                onchange="this.form.submit();">
                                <option value="">Semua Tingkat</option>
                                <option value="10" {{ request('tingkat') == '10' ? 'selected' : '' }}>10</option>
                                <option value="11" {{ request('tingkat') == '11' ? 'selected' : '' }}>11</option>
                                <option value="12" {{ request('tingkat') == '12' ? 'selected' : '' }}>12</option>
                            </select>

                            <select name="jurusan" id="jurusan"
                                class="block w-32 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                onchange="this.form.submit();">
                                <option value="">Semua Jurusan</option>
                                @foreach ($jurusans as $j)
                                    <option value="{{ $j->id_jurusan }}"
                                        {{ request('jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                                        {{ $j->id_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div id="accordion-collapse" data-accordion="collapse">
                        @foreach ($kelasData as $kelas)
                            <div id="accordion-collapse-{{ $kelas['kelas_id'] }}"
                                class="bg-white shadow-md w-full h-auto rounded-lg my-3 border">
                                <h2 id="accordion-collapse-heading-{{ $kelas['kelas_id'] }}">
                                    <button type="button"
                                        class="flex justify-between items-center w-full p-5 font-medium text-gray-500 border-b border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                        data-accordion-target="#accordion-collapse-body-{{ $kelas['kelas_id'] }}"
                                        aria-expanded="false"
                                        aria-controls="accordion-collapse-body-{{ $kelas['kelas_id'] }}">
                                        <div class="flex flex-col w-full">
                                            <span class="font-bold text-[20px]">{{ $kelas['kelas'] }}</span>
                                            <div class="mt-2 w-full bg-green-200 rounded-full h-6">
                                                <div class="bg-green-500 rounded-full h-6 flex items-center justify-center text-white font-bold"
                                                    style="width: {{ number_format($kelas['percentageHadir']) }}%;">
                                                    Hadir {{ number_format($kelas['percentageHadir'], 2) }}%
                                                </div>
                                            </div>
                                        </div>
                                        <svg data-accordion-icon class="w-3 h-3 transform transition-transform"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                                </h2>

                                <div id="accordion-collapse-body-{{ $kelas['kelas_id'] }}" class="hidden"
                                    aria-labelledby="accordion-collapse-heading-{{ $kelas['kelas_id'] }}">
                                    <div class="p-5 bg-white border-t border-gray-200 !rounded-md dark:border-gray-700">
                                        <div class="flex justify-between items-center">
                                            <div class="w-full">
                                                <div class="grid grid-cols-3 gap-4">
                                                    <div class="card">
                                                        <div class="card-body border-l-8 border-green-500">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="state">
                                                                    <h3 class="text-green-500 text-lg">
                                                                        {{ $kelas['countHadir'] }}x</h3>
                                                                    <p class="card-subtitle text-muted fw-500 text-xl">
                                                                        Hadir</p>
                                                                </div>
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
                                                                        <path fill-rule="evenodd"
                                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm2.023 6.828a.75.75 0 1 0-1.06-1.06 3.75 3.75 0 0 1-5.304 0 .75.75 0 0 0-1.06 1.06 5.25 5.25 0 0 0 7.424 0Z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <div class="progress mt-3 mb-1 !h-2 bg-green-200"
                                                                style="height: 6px;">
                                                                <div class="progress-bar bg-green-500 " role="progressbar"
                                                                    style="width: {{ $kelas['percentageHadir'] }}%;"
                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <div class="text-muted f12">
                                                                <span
                                                                    class="float-right">{{ number_format($kelas['percentageHadir'], 2) }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-body border-l-8 border-cyan-500">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="state">
                                                                    <h3 class="text-aqua text-lg">
                                                                        {{ $kelas['countSakitIzin'] }}x</h3>
                                                                    <p class="card-subtitle text-muted fw-500 text-xl">
                                                                        Sakit/Izin</p>
                                                                </div>
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
                                                                        <path fill-rule="evenodd"
                                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm-4.34 7.964a.75.75 0 0 1-1.061-1.06 5.236 5.236 0 0 1 3.73-1.538 5.236 5.236 0 0 1 3.695 1.538.75.75 0 1 1-1.061 1.06 3.736 3.736 0 0 0-2.639-1.098 3.736 3.736 0 0 0-2.664 1.098Z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <div class="progress mt-3 mb-1 !h-2 bg-cyan-200"
                                                                style="height: 6px;">
                                                                <div class="progress-bar bg-aqua" role="progressbar"
                                                                    style="width: {{ $kelas['percentageSakitIzin'] }}%;"
                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <div class="text-muted f12">
                                                                <span
                                                                    class="float-right">{{ number_format($kelas['percentageSakitIzin'], 2) }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-body border-l-8 border-red-700">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="state">
                                                                    <h3 class="text-red-700 text-lg">
                                                                        {{ $kelas['countAlfa'] }}x</h3>
                                                                    <p class="card-subtitle text-muted fw-500 text-xl">Alfa
                                                                    </p>
                                                                </div>
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
                                                                        <path fill-rule="evenodd"
                                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <div class="progress mt-3 mb-1 !h-2 bg-red-200"
                                                                style="height: 6px;">
                                                                <div class="progress-bar bg-red-700" role="progressbar"
                                                                    style="width: {{ $kelas['percentageAlfa'] }}%;"
                                                                    aria-valuenow="25" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <div class="text-muted f12">
                                                                <span
                                                                    class="float-right">{{ number_format($kelas['percentageAlfa'], 2) }}%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="{{ route('kesiswaan.siswa', ['kelas_id' => $kelas['kelas_id']]) }}"
                                                    class="flex justify-center">
                                                    <button
                                                        class="bg-slate-50 w-full h-auto m-2 rounded-lg text-lg font-bold flex items-center justify-center p-3 hover:bg-slate-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="w-6 h-6 mr-1">
                                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Detail
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination flex justify-end p-3 text-sm sm:text-lg">
                        {{ $kelasData->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @endsection
