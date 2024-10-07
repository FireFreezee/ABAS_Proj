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
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                <div class="flex">
                    <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: auto; width: 2rem;" alt="lavalite">
                    <img src="{{ asset('assets/img/logo-title.png') }}" style="height: 2rem; width: auto;" class="text"
                        alt="lavalite">
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
                        <a href="{{ route('kesiswaan.index') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    <div class="nav-lavel">Laporan</div>
                    <div class="nav-item active">
                        <a href="{{ route('kesiswaan.kelas') }}"><i class="ik ik-inbox"></i><span>Laporan Absensi</span></a>
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
                <div class="progress mt-3 mb-1 !h-9 bg-green-200" style="height: 6px;">
                    <div class="progress-bar bg-green-500" role="progressbar" style="width: {{ $averagePercentageHadir }}%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="text-lg">Hadir {{ number_format($averagePercentageHadir) }}%</div>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <h5 class="font-bold text-[20px] mb-4">
                    Kelas
                </h5>
                @foreach ($kelasData as $kelas)
                    <div class="bg-white shadow-md w-full h-auto rounded-lg my-4">
                        <div class="p-2">
                            <div class="flex justify-between">
                                <div class="w-full m-2">
                                    <h5 class="font-bold text-[20px]">
                                        {{ $kelas['kelas'] }}
                                    </h5>
                                    <div class="progress mt-3 mb-1 !h-9 bg-green-200" style="height: 6px;">
                                        <div class="progress-bar bg-green-500" role="progressbar"
                                            style="width: {{ number_format($kelas['percentageHadir']) }}%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <div class="text-lg">Hadir {{ number_format($kelas['percentageHadir']) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('kesiswaan.siswa', ['kelas_id' => $kelas['kelas_id']]) }}" class="flex justify-center">
                                    <button
                                        class="bg-slate-50 w-28 h-auto m-2 rounded-lg text-lg font-bold flex items-center p-3 hover:bg-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd"
                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Detail</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
