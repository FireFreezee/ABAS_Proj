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
                        <a href="{{ route('walikelas-dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    <div class="nav-lavel">Laporan</div>
                    <div class="nav-item active">
                        <a href="{{ route('list-siswa') }}"><i class="ik ik-inbox"></i><span>Laporan Absensi</span></a>
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
            <div class="grid grid-cols-2 bg-white pt-2 pr-2 rounded-lg mb-2">
                <div></div>
                <form action="{{ route('list-siswa', ['kelas_id' => $kelas->id_kelas] ) }}" method="GET">
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
            <h5 class="font-bold text-[20px] mb-4">
                Rata-Rata
            </h5>
            <div class="grid grid-cols-5 gap-4">
                <div class="card ">
                    <div class="card-body border-l-8 border-green-500">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-green-500 text-lg"></h3>
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
                            <div class="progress-bar bg-green-500 " role="progressbar" style="width: {{ $averageAttendancePercentages['Hadir'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($averageAttendancePercentages['Hadir']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-cyan-500">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-aqua text-lg"></h3>
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
                            <div class="progress-bar bg-aqua" role="progressbar" style="width: {{ $averageAttendancePercentages['Sakit/Izin'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($averageAttendancePercentages['Sakit/Izin']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-red-700">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-red-700 text-lg"></h3>
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
                            <div class="progress-bar bg-red-700" role="progressbar" style="width: {{ $averageAttendancePercentages['Alfa'] }}%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($averageAttendancePercentages['Alfa']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-gray-400">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-400 text-lg"></h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">Terlambat</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2 bg-gray-200" style="height: 6px;">
                            <div class="progress-bar bg-gray-400" role="progressbar" style="width: {{ $averageAttendancePercentages['Terlambat'] }}%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($averageAttendancePercentages['Terlambat']) }}%</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border-l-8 border-gray-900">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-900 text-lg"></h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">TAP</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2 bg-gray-300" style="height: 6px;">
                            <div class="progress-bar bg-gray-900" role="progressbar" style="width: {{ $averageAttendancePercentages['TAP'] }}%;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($averageAttendancePercentages['TAP']) }}%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 bg-gradient-to-t from-[#F6F7FB] from-10% to-white p-3 to-90% rounded-3xl">
                <div class="flex justify-between items-center">
                    <h5 class="font-bold text-[20px]">
                        {{ $kelas->tingkat }} {{ $kelas->id_jurusan }} {{ $kelas->nomor_kelas }}
                    </h5>
                    <div class="grid grid-cols-2 place-items-end items-center">
                        <button class="bg-blue-700 hover:bg-blue-800 text-white px-4 w-fit h-10 rounded-lg">
                            Export
                        </button>
                        <form class="max-w-md mx-2">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search"
                                    class="block w-[300px] ml-5 h-[5px] p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Mockups, Logos..." required />
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                @foreach ($studentsData as $student)
                    <div class="bg-white w-full h-auto rounded-lg my-3 shadow-md border-spacing-1 border">
                        <div class="p-2">
                            <div class="flex justify-between">
                                <div class="w-full m-2">
                                    <div class="flex justify-between">
                                        <h5 class="font-bold text-[17px]">
                                            {{ $student['name'] }}
                                        </h5>
                                        <h5 class="font-bold text-[17px]">
                                           NIS : {{ $student['nis'] }}
                                        </h5>
                                    </div>
                                    <div class="progress mt-3 mb-1 !h-4 bg-gray-300" style="height: 6px;">
                                        <div class="progress-bar bg-green-500" role="progressbar" style="width: {{ $student['attendancePercentages']['Hadir'] }}%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <div class="text-xs">Hadir {{ number_format($student['attendancePercentages']['Hadir']) }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('detail-siswa', ['id' => $student['nis']]) }}" class="flex justify-center">
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
                <div class="pagination flex justify-end p-3 text-sm sm:text-lg ">
                    {{ $studentsData->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
