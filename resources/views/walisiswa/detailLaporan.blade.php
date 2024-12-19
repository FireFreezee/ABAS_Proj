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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </script>
    <title>ABAS - Dashboard</title>
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
                                <a href="{{ route('walsis-dashboard') }}"
                                    class="decoration-transparent items-center group lg:text-sm bg-slate-100 hover:bg-blue-600 font-semibold text-white rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div
                                        class="text-slate-900 text-[10px] lg:text-[15px] group-hover:text-white flex items-center">
                                        Dashboard</div>
                                </a>
                                <a href="{{ route('detail-laporan') }}"
                                    class="decoration-transparent group items-center bg-blue-600 hover:bg-blue-600 text-white font-semibold p-[10px] rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div class=" text-[10px] lg:text-[15px] text-white flex items-center">
                                        Laporan</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="top-menu flex justify-end items-center pr-2">
                        <div class="dropdown">
                            <a class="!bg-white" href="#" id="userDropdown" role="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar overflow-hidden !flex !justify-center">
                                    <img class="!bg-white !h-full !max-w-fit"
                                        src="{{ asset('storage/uploads/profile/' . Auth::user()->foto) }}"
                                        alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('walsis-profile') }}"><i
                                        class="ik ik-user dropdown-icon"></i>
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
                <div class="container-fluid" style="margin-left: 0px; margin-right: 0px; max-width: none;">
                    <div class="grid grid-cols-2 mt-6">
                        <div></div>
                        <form action="{{ route('detail-laporan') }}" method="GET">
                            <div id="date-range-picker" class="flex justify-end items-center gap-4 pb-2">
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
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                            data-tabs-toggle="#default-tab-content" role="tablist">

                            @foreach ($siswas as $index => $siswa)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                        id="tab-{{ $siswa->nis }}" data-tabs-target="#siswa-{{ $siswa->nis }}"
                                        type="button" role="tab" aria-controls="siswa-{{ $siswa->nis }}"
                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                        <h1>
                                            {{ $siswa->user->nama }}
                                        </h1>
                                        <h1>
                                            {{ $siswa->nis }}
                                        </h1>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div id="default-tab-content">
                        @foreach ($siswas as $index => $siswa)
                            <div class="{{ $index === 0 ? '' : 'hidden' }} p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                                id="siswa-{{ $siswa->nis }}" role="tabpanel"
                                aria-labelledby="tab-{{ $siswa->nis }}">
                                <div class="grid grid-cols-3 gap-4">
                                    <!-- Hadir Card -->
                                    <div class="card">
                                        <div class="card-body border-l-8 border-green-500">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h3 class="text-green-500 text-lg">
                                                        {{ $siswa->getAttribute('Hadir/Terlambat/TAP') }}</h3>
                                                    <p class="card-subtitle text-muted fw-500 text-xl">Hadir</p>
                                                </div>
                                            </div>
                                            <div class="progress mt-3 mb-1 !h-2 bg-green-200" style="height: 6px;">
                                                <div class="progress-bar bg-green-500" role="progressbar"
                                                    style="width: {{ $siswa->persentaseHadir }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseHadir }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <div class="text-muted f12">
                                                <span
                                                    class="float-right">{{ number_format($siswa->persentaseHadir) }}%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sakit/Izin Card -->
                                    <div class="card">
                                        <div class="card-body border-l-8 border-cyan-500">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h3 class="text-aqua text-lg">
                                                        {{ $siswa->getAttribute('Sakit/Izin') }}</h3>
                                                    <p class="card-subtitle text-muted fw-500 text-xl">Sakit/Izin</p>
                                                </div>
                                            </div>
                                            <div class="progress mt-3 mb-1 !h-2 bg-cyan-200" style="height: 6px;">
                                                <div class="progress-bar bg-aqua" role="progressbar"
                                                    style="width: {{ $siswa->persentaseSakitIzin }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseSakitIzin }}"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="text-muted f12">
                                                <span
                                                    class="float-right">{{ number_format($siswa->persentaseSakitIzin) }}%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alfa Card -->
                                    <div class="card">
                                        <div class="card-body border-l-8 border-red-700">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="state">
                                                    <h3 class="text-red-700 text-lg">
                                                        {{ $siswa->Alfa }}</h3>
                                                    <p class="card-subtitle text-muted fw-500 text-xl">Alfa</p>
                                                </div>
                                            </div>
                                            <div class="progress mt-3 mb-1 !h-2 bg-red-200" style="height: 6px;">
                                                <div class="progress-bar bg-red-700" role="progressbar"
                                                    style="width: {{ $siswa->persentaseAlfa }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseAlfa }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <div class="text-muted f12">
                                                <span
                                                    class="float-right">{{ number_format($siswa->persentaseAlfa) }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th class="!text-[11px] sm:!text-base">Tanggal</th>
                                                <th class="!text-[11px] sm:!text-base">Keterangan</th>
                                                <th class="!text-[11px] sm:!text-base">Jam Masuk</th>
                                                <th class="!text-[11px] sm:!text-base">Jam Pulang</th>
                                                <th class="!text-[11px] sm:!text-base">Detail Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentAttendanceData[$siswa->nis] as $absen)
                                                <tr>
                                                    <td class="!text-[11px] sm:!text-base">{{ $absen['date'] }}</td>
                                                    <td class="!text-[11px] sm:!text-base flex justify-center">
                                                        @if ($absen['status'] == 'Hadir')
                                                            <div
                                                                class="bg-green-500 h-fit w-14 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @elseif ($absen['status'] == 'Sakit')
                                                            <div
                                                                class="bg-cyan-500 h-fit w-14 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @elseif ($absen['status'] == 'Izin')
                                                            <div
                                                                class="bg-orange-400 h-fit w-14 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @elseif ($absen['status'] == 'Alfa')
                                                            <div
                                                                class="bg-red-700 h-fit w-14 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @elseif ($absen['status'] == 'Terlambat')
                                                            <div
                                                                class="bg-gray-400 h-fit w-25 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @elseif ($absen['status'] == 'TAP')
                                                            <div
                                                                class="bg-gray-900 h-fit w-14 p-1 rounded-md text-white">
                                                                {{ $absen['status'] }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="!text-[11px] sm:!text-base">
                                                        {{ $absen['jam_masuk'] }}
                                                    </td>
                                                    <td class="!text-[11px] sm:!text-base">
                                                        {{ $absen['jam_pulang'] }}
                                                    </td>
                                                    <td class="!text-[11px] sm:!text-base">
                                                        <button
                                                            data-modal-target="default-modal-{{ $absen['id_absensi'] }}"
                                                            data-modal-toggle="default-modal-{{ $absen['id_absensi'] }}"
                                                            class="bg-blue-500 h-fit w-[70px] rounded-full p-1 hover:bg-blue-800 hover:text-white">Detail</button>
                                                    </td>
                                                </tr>

                                                <!-- Modal for each record -->
                                                <div id="default-modal-{{ $absen['id_absensi'] }}" tabindex="-1"
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
                                                                    data-modal-hide="default-modal-{{ $absen['id_absensi'] }}"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-hide="default-modal">
                                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <div class="pt-3">
                                                                <p><strong>Keterangan:</strong> {{ $absen['status'] }}
                                                                </p>
                                                                <p><strong>Tanggal Absen:</strong> {{ $absen['date'] }}
                                                                </p>
                                                                {{-- <p><strong>Jam Masuk:</strong>
                                                                    {{ $absen['jam_masuk'] }}</p>
                                                                <p><strong>Jam Pulang:</strong>
                                                                    {{ $absen['jam_pulang'] }}</p> --}}
                                                                @if ($absen['menit_keterlambatan'] > 0)
                                                                    <p><strong>Keterlambatan:</strong>
                                                                        {{ $absen['menit_keterlambatan'] }} Menit</p>
                                                                @endif
                                                                @if ($absen['status'] == 'Hadir' || $absen['status'] == 'Terlambat' || $absen['status'] == 'TAP')
                                                                    <div class="grid grid-cols-2 gap-2">
                                                                        <p><strong>Foto Masuk:</strong>
                                                                            @if ($absen['photo_in'] > 0)
                                                                                <img src="{{ asset('storage/uploads/absensi/' . $absen['photo_in']) }}"
                                                                                    alt="">
                                                                            @else
                                                                                Data Tidak Tersedia
                                                                            @endif
                                                                        </p>
                                                                        <p><strong>Foto Pulang:</strong>
                                                                            @if ($absen['photo_out'] > 0)
                                                                                <img src="{{ asset('storage/uploads/absensi/' . $absen['photo_out']) }}"
                                                                                    alt="">
                                                                            @else
                                                                                Data Tidak Tersedia
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($absen['status'] == 'Sakit' || $absen['status'] == 'Izin')
                                                                    <p><strong>Foto Keterangan:</strong>
                                                                        @if ($absen['photo_in'] > 1)
                                                                            <img src="{{ asset('storage/uploads/absensi/' . $absen['photo_in']) }}"
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

                                    <!-- Pagination links -->
                                    <div class="pagination flex justify-end p-3 text-sm sm:text-lg ">
                                        {{ $studentAttendanceData[$siswa->nis]->links('vendor.pagination.bootstrap-5') }}
                                        <!-- Display pagination links -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
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
</body>

</html>
