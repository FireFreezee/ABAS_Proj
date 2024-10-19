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
                <form action="{{ route('kesiswaan.detail.siswa', ['id' => $students->nis]) }}" method="GET">
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
                                <h3 class="text-green-500 text-lg">{{ $attendanceCounts['Hadir'] }}x</h3>
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
                                style="width: {{ $attendancePercentage['percentageHadir'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($attendancePercentage['percentageHadir']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-cyan-500">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-aqua text-lg">{{ $attendanceCounts['Sakit/Izin'] }}x</h3>
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
                                style="width: {{ $attendancePercentage['percentageSakitIzin'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span
                                class="float-right">{{ number_format($attendancePercentage['percentageSakitIzin']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-red-700">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-red-700 text-lg">{{ $attendanceCounts['Alfa'] }}x</h3>
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
                                style="width: {{ $attendancePercentage['percentageAlfa'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($attendancePercentage['percentageAlfa']) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body border-l-8 border-gray-400">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-400 text-lg">{{ $attendanceCounts['Terlambat'] }}x</h3>
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
                            <div class="progress-bar bg-gray-400" role="progressbar"
                                style="width: {{ $attendancePercentage['percentageTerlambat'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span
                                class="float-right">{{ number_format($attendancePercentage['percentageTerlambat']) }}%</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border-l-8 border-gray-900">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-900 text-lg">{{ $attendanceCounts['TAP'] }}x</h3>
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
                            <div class="progress-bar bg-gray-900" role="progressbar"
                                style="width: {{ $attendancePercentage['percentageTAP'] }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($attendancePercentage['percentageTAP']) }}%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header flex justify-between">
                    <div>
                        <h3>{{ $students->user->nama }}</h3>
                        <span>{{ $students->nis }}</span>
                    </div>
                </div>
                <div class="card-body p-0 table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($present as $absensi)
                                    <tr class="text-center">
                                        <th>{{ $absensi->date }}</th>
                                        <td class="flex justify-center">
                                            @if ($absensi->status == "Hadir")
                                            <div class="bg-green-500 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @elseif ($absensi->status == "Sakit")
                                            <div class="bg-cyan-500 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @elseif ($absensi->status == "Izin")
                                            <div class="bg-orange-400 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @elseif ($absensi->status == "Alfa")
                                            <div class="bg-red-700 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @elseif ($absensi->status == "Terlambat")
                                            <div class="bg-gray-400 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @elseif ($absensi->status == "TAP")
                                            <div class="bg-gray-900 h-fit w-14 p-1 rounded-md">
                                                {{ $absensi->status }}
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <button data-modal-target="default-modal-{{ $absensi->id_absensi }}"
                                                data-modal-toggle="default-modal-{{ $absensi->id_absensi }}"
                                                class="bg-slate-700 text-white p-2 rounded-md">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                    <div id="default-modal-{{ $absensi->id_absensi }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 px-7 pb-7">
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Detail Absen</h3>
                                                    <button type="button"
                                                        data-modal-hide="default-modal-{{ $absensi->id_absensi }}"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="default-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <div class="pt-3">
                                                    <p><strong>Keterangan:</strong> {{ $absensi->status }}
                                                    </p>
                                                    <p><strong>Tanggal Absen:</strong> {{ $absensi->date }}</p>
                                                    <p><strong>Jam Masuk:</strong>
                                                        {{ $absensi->jam_masuk }}</p>
                                                    <p><strong>Jam Pulang:</strong>
                                                        {{ $absensi->jam_pulang }}</p>
                                                    @if ($absensi->menit_keterlambatan > 0)
                                                        <p><strong>Keterlambatan:</strong>
                                                            {{ $absensi->menit_keterlambatan }} Menit</p>
                                                    @endif
                                                    @if ($absensi->status == 'Hadir' || $absensi->status == 'Terlambat' || $absensi->status == 'TAP')
                                                        <div class="grid grid-cols-2 gap-2">
                                                            <p><strong>Foto Masuk:</strong>
                                                                @if ($absensi->photo_in > 0)
                                                                <img
                                                                    src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}"
                                                                    alt="">
                                                                @else
                                                                Data Tidak Tersedia
                                                                @endif
                                                            </p>
                                                            <p><strong>Foto Pulang:</strong>
                                                                @if ($absensi->photo_out > 0)
                                                                <img
                                                                    src="{{ asset('storage/uploads/absensi/' . $absensi->photo_out) }}"
                                                                    alt="">
                                                                @else
                                                                Data Tidak Tersedia
                                                                @endif
                                                            </p>
                                                        </div>
                                                    @endif
                                                    @if ($absensi->status == 'Sakit' || $absensi->status == 'Izin')
                                                        <p><strong>Foto Keterangan:</strong>
                                                            @if ($absensi->photo_in > 0)
                                                                <img
                                                                    src="{{ asset('storage/uploads/absensi/' . $absensi->photo_in) }}"
                                                                    alt="">
                                                                @else
                                                                Data Tidak Tersedia
                                                                @endif
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination flex justify-end p-3 text-sm sm:text-lg ">
                            {{ $present->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
