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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <a class="!bg-white" href="#" id="userDropdown" role="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar overflow-hidden !flex !justify-center">
                                    <img class="!bg-white !h-full !max-w-fit"
                                        src="{{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}"
                                        alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('siswa-profile') }}"><i
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
        @php
            $isAbsenMasukDisabled = $jam < $jam_absen || $jam >= $batas_absen_pulang;
            $isAbsenPulang = $statusAbsen === 'Sudah Pulang';
            $isIzin = $statusAbsen === 'Izin' || $statusAbsen === 'Sakit';
            // $isJarak = $userLatLng > $schoolLatLng;
        @endphp
        <div
            class="fixed bottom-[63px] left-0 z-50 w-full h-16 bg-white border-t border-gray-400 rounded-t-3xl dark:bg-gray-700 dark:border-gray-600 lg:hidden">
            <div class="grid h-full max-w-lg grid-cols-2 mx-auto py-2.5 !gap-3 place-items-center">
                <a href="{{ route('siswa-absen') }}" style="text-decoration: none">
                    @if ($cek > 0)
                        <button class="btn-absen btn-danger bg-red-600 px-1 w-36 rounded-xl font-bold"
                            style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) background-color: gray; color: white; border: none; @endif"
                            @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) disabled @endif><i class="ik ik-maximize"></i>&nbsp; Absen
                            Pulang
                            <h4 class="text-[10px] font-normal">Jam Absen
                                {{ $waktu->jam_pulang }}-{{ $waktu->batas_absen_pulang }}</h4>
                        </button>
                    @else
                        <button class="btn-absen btn-primary bg-blue-500 px-1 w-36 rounded-xl font-bold"
                            style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled) background-color: gray; color: white; border: none; @endif"
                            @if ($isAbsenMasukDisabled) disabled @endif><i class="ik ik-maximize"></i>&nbsp; Absen
                            Pulang
                            <h4 class="text-[10px] font-normal">Jam Absen
                                {{ $waktu->jam_pulang }}-{{ $waktu->batas_absen_pulang }}</h4>
                        </button>
                    @endif
                </a>
                <a href="{{ route('siswa-izin') }}" style="text-decoration: none">
                    @if ($cek > 0)
                        <button class="btn-absen btn-info bg-cyan-400 px-1 w-36 rounded-xl font-bold"
                            style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; background-color: gray; color: white; border: none;"
                            disabled><i class="ik ik-user-x"></i>&nbsp;
                            Izin/Sakit <h4 class="text-[10px] font-normal">Form Izin dan Sakit</h4>
                        </button>
                    @else
                        <button class="btn-absen btn-info bg-cyan-400 px-1 w-36 rounded-xl font-bold"
                            style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled) background-color: gray; color: white; border: none; @endif"
                            @if ($isAbsenMasukDisabled) disabled @endif><i class="ik ik-user-x"></i>&nbsp;
                            Izin/Sakit <h4 class="text-[10px] font-normal">Form Izin dan Sakit</h4>
                        </button>
                    @endif
                </a>

            </div>
        </div>
        <div
            class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t dark:bg-gray-700 dark:border-gray-600 lg:hidden">
            <div class="grid h-full max-w-lg grid-cols-2 mx-auto font-medium">
                <a type="button" href="{{ route('siswa-dashboard') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
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
            <div class="bg-gradient-to-r to-blue-500 from-blue-600 w-full h-56 absolute shadow-2xl"></div>
            <div class="main-content" style="padding-left: 0px; padding-right: 0px">
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
                <input type="hidden" id="lokasi">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-20">
                                <div class="flex justify-center">
                                    <div class="rounded-circle !overflow-hidden !h-[150px] !w-[150px] !flex !justify-center">
                                        <img src="{{ asset('storage/uploads/foto_profil/' . Auth::user()->foto) }}"
                                            alt="Foto Profil" class="!h-full !max-w-max">
                                    </div>
                                </div>
                                <h4 class="mt-20 mb-0">{{ Auth::user()->nama }}</h4>
                                <a href="#" style="text-decoration: none">{{ Auth::user()->email }}</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="container-fluid" style="margin-left: 0px; margin-right: 0px; max-width: none;">

                    <div class="row clearfix">
                        <div class="col-6 col-md-3 col-sm-12">
                            <div class="widget bg-purple card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state mr-1.5">
                                            <h6 class="text-[14px] sm:text-base !font-bold mb-2">Tanggal</h6>
                                            <h5 id="date" class="text-[10px] sm:text-xs md:text-base !mb-0">Senin
                                                15
                                                September 2024</h5>
                                        </div>
                                        <div class="icon !text-[20px] sm:!text-[37px]">
                                            <i class="ik ik-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 col-sm-12">
                            <div class="widget bg-success card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state mr-1.5">
                                            <h6 class="text-[14px] sm:text-base !font-bold mb-2">Jam Sekarang</h6>
                                            <h5 class="clock text-[15px] sm:text-base !mb-0">
                                                <span id="jam">00</span>
                                                <span>:</span>
                                                <span id="menit">00</span>
                                                <span>:</span>
                                                <span id="detik">00</span>
                                            </h5>
                                        </div>
                                        <div class="icon !text-[20px] sm:!text-[37px] sm:py-0 py-2.5">
                                            <i class="ik ik-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-sm-12">
                            <div class="widget bg-yellow card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6 class="text-[14px] sm:text-base !font-bold mb-2">Jarak dari sekolah
                                            </h6>
                                            <h5 id="distance" class="text-[13px] sm:text-base !mb-0">Jarak </h5>
                                        </div>
                                        <div class="icon !text-[20px] sm:!text-[37px]">
                                            <i class="ik ik-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-sm-12">
                            @if ($statusAbsen == 'Belum Absen')
                                <div class="widget card-keterangan" style="background-color: grey; color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}
                                                </h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($statusAbsen == 'Hadir')
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(0, 182, 0); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($statusAbsen == 'Terlambat')
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(14, 78, 1); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($statusAbsen == 'Sakit')
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(167, 179, 0); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($statusAbsen == 'Izin')
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(6, 231, 220); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($statusAbsen == 'Alfa')
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(255, 0, 0); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="widget card-keterangan"
                                    style="background-color: rgb(255, 0, 0); color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6 class="text-[14px] sm:text-base !font-bold mb-2">Status Kehadiran
                                                </h6>
                                                <h5 class="text-[13px] sm:text-base !mb-0">Sudah Pulang</h5>
                                            </div>
                                            <div class="icon !text-[20px] sm:!text-[37px]">
                                                <i class="ik ik-inbox" style="color: white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <div class="widget bg-blue card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6 class="text-[14px] sm:text-base !font-bold mb-2">Absen Masuk</h6>
                                            <h4 class="text-[13px] sm:text-base !mb-0">10:10</h4>
                                        </div>
                                        <div class="icon !text-[20px] sm:!text-[37px]">
                                            <i class="ik ik-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            <div class="widget bg-red card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6 class="text-[14px] sm:text-base !font-bold mb-2">Absen Pulang</h6>
                                            <h4 class="text-[13px] sm:text-base !mb-0">10:10</h4>
                                        </div>
                                        <div class="icon !text-[20px] sm:!text-[37px]">
                                            <i class="ik ik-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix ">
                        <div class="col-md-6 sm-3 col-sm-12 !hidden lg:!block">
                            <a href="{{ route('siswa-absen') }}" style="text-decoration: none">
                                @if ($cek > 0)
                                    <button type="button"
                                        class="btn-absen btn-danger bg-red-600 btn-block pb-30 pt-30"
                                        style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) background-color: gray; color: white; border: none; @endif"
                                        @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) disabled @endif><i
                                            class="ik ik-maximize"></i>&nbsp; Absen Pulang<h4
                                            style="font-size: 1rem; font-weight: 500;">Jam Absen
                                            {{ $waktu->jam_pulang }}-{{ $waktu->batas_absen_pulang }}</h4></button>
                                @else
                                    <button type="button"
                                        class="btn-absen btn-primary bg-blue-500 btn-block pb-30 pt-30"
                                        style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled) background-color: gray; color: white; border: none; @endif"
                                        @if ($isAbsenMasukDisabled) disabled @endif>
                                        <i class="ik ik-maximize"></i>&nbsp; Absen Masuk<h4
                                            style="font-size: 1rem; font-weight: 500;">Jam Absen
                                            {{ $jam_absen }}-{{ $waktu->batas_absen_masuk }} WIB</h4></button>
                                @endif
                            </a>
                        </div>
                        <div class="col-md-6 sm-3 col-sm-12 !hidden lg:!block">
                            <a href="{{ route('siswa-izin') }}" style="text-decoration: none">
                                @if ($cek > 0)
                                    <button type="button" class="btn-absen btn-secondary btn-block pb-30 pt-30"
                                        style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; background-color: gray; color: white; border: none;"
                                        disabled><i class="ik ik-user-x"></i>&nbsp; Izin/Sakit <h4
                                            style="font-size: 1rem; font-weight: 500;">Form Izin dan Sakit
                                        </h4>
                                    </button>
                                @else
                                    <button type="button"
                                        class="btn-absen btn-info bg-cyan-400 btn-block pb-30 pt-30"
                                        style="font-size: 1rem; font-weight: 500; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled) background-color: gray; color: white; border: none; @endif"
                                        @if ($isAbsenMasukDisabled) disabled @endif><i
                                            class="ik ik-user-x"></i>&nbsp; Izin/Sakit <h4
                                            style="font-size: 1rem; font-weight: 500;">Form Izin dan Sakit</h4>
                                    </button>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header d-block">
                                    <h3 class="!text-sm sm:!text-[23px] !font-semibold">Absen Minggu Ini</h3>
                                </div>
                                <div class="card-body p-0 table-border-style">
                                    <div class="table-responsive">
                                        <table class="table" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="!text-xs sm:!text-base">Tanggal</th>
                                                    <th class="!text-xs sm:!text-base">Status</th>
                                                    <th class="!text-xs sm:!text-base">Absen Masuk</th>
                                                    <th class="!text-xs sm:!text-base">Absen Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayatmingguini as $riwayatM)
                                                    <tr>
                                                        <th class="!text-xs sm:!text-base">{{ $riwayatM->date }}</th>
                                                        <td class="!text-xs sm:!text-base">
                                                            @if ($riwayatM->status == 'Hadir')
                                                                <span
                                                                    class="status hadir">{{ $riwayatM->status }}</span>
                                                            @elseif ($riwayatM->status == 'Terlambat')
                                                                <span
                                                                    class="status terlambat">{{ $riwayatM->status }}</span>
                                                            @elseif ($riwayatM->status == 'TAP')
                                                                <span
                                                                    class="status tap">{{ $riwayatM->status }}</span>
                                                            @elseif ($riwayatM->status == 'Sakit' || $riwayatM->status == 'Izin')
                                                                <span
                                                                    class="status izin">{{ $riwayatM->status }}</span>
                                                            @elseif ($riwayatM->status == 'Alfa')
                                                                <span
                                                                    class="status alfa">{{ $riwayatM->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="!text-xs sm:!text-base">{{ $riwayatM->jam_masuk }}
                                                        </td>
                                                        <td class="!text-xs sm:!text-base">{{ $riwayatM->jam_pulang }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-[90px] sm:mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title !text-sm sm:!text-[23px] !font-semibold">Jumlah Kehadiran
                                        Anda</h3>
                                    <div class="w-full">
                                        <div class="nav-tabs grid grid-cols-2 mx-3 mt-3" id="nav-tab"
                                            role="tablist">
                                            <button class="nav-link active !text-xs sm:!text-base w-full p-2"
                                                id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#bulan_ini"
                                                type="button" role="tab" aria-controls="nav-home"
                                                aria-selected="true">Bulan Ini</button>
                                            <button class="nav-link !text-xs sm:!text-base w-full"
                                                id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#bulan_sebelumnya" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">Bulan
                                                Sebelumnya</button>
                                        </div>
                                    </div>

                                    <div class="tab-content mt-15" id="myTabContent">
                                        <div class="tab-pane fade show active" id="bulan_ini" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row mb-15">
                                                    <div class="col-9 !text-xs sm:!text-base">Hadir :
                                                        {{ $dataBulanIni['Hadir'] ?? 0 }}
                                                    </div>
                                                    <div class="col-3 text-right !text-xs sm:!text-base">
                                                        {{ $persentaseHadirBulanIni }}%
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-green" role="progressbar"
                                                                style="width: {{ $persentaseHadirBulanIni }}%"
                                                                aria-valuenow="{{ $persentaseHadirBulanIni }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9 !text-xs sm:!text-base">Sakit/Izin :
                                                        {{ $dataBulanIni['Sakit/Izin'] ?? 0 }}</div>
                                                    <div class="col-3 text-right !text-xs sm:!text-base">
                                                        {{ $persentaseSakitIzinBulanIni }}%
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-aqua" role="progressbar"
                                                                style="width: {{ $persentaseSakitIzinBulanIni }}%"
                                                                aria-valuenow="{{ $persentaseSakitIzinBulanIni }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9 !text-xs sm:!text-base">Terlambat :
                                                        {{ $dataBulanIni['Terlambat'] ?? 0 }}</div>
                                                    <div class="col-3 text-right !text-xs sm:!text-base">
                                                        {{ $persentaseTerlambatBulanIni }}%
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar !bg-gray-700" role="progressbar"
                                                                style="width: {{ $persentaseTerlambatBulanIni }}%"
                                                                aria-valuenow="{{ $persentaseTerlambatBulanIni }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9 !text-xs sm:!text-base">Alfa :
                                                        {{ $dataBulanIni['Alfa'] ?? 0 }}</div>
                                                    <div class="col-3 text-right !text-xs sm:!text-base">
                                                        {{ $persentaseAlfaBulanIni }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: {{ $persentaseAlfaBulanIni }}%"
                                                                aria-valuenow="{{ $persentaseAlfaBulanIni }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9 !text-xs sm:!text-base">TAP :
                                                        {{ $dataBulanIni['TAP'] ?? 0 }}</div>
                                                    <div class="col-3 text-right !text-xs sm:!text-base">
                                                        {{ $persentaseTAPBulanIni }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar !bg-red-700" role="progressbar"
                                                                style="width: {{ $persentaseTAPBulanIni }}%"
                                                                aria-valuenow="{{ $persentaseTAPBulanIni }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9 !text-xs sm:!text-base">Total
                                                        Keterlambatan :
                                                        {{ $late }} Menit</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bulan_sebelumnya" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="row mb-15">
                                                    <div class="col-9">Hadir:
                                                        {{ $dataBulanSebelumnya['Hadir'] ?? 0 }}</div>
                                                    <div class="col-3 text-right">
                                                        {{ $persentaseHadirBulanSebelumnya }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-green" role="progressbar"
                                                                style="width: {{ $persentaseHadirBulanSebelumnya }}%"
                                                                aria-valuenow="{{ $persentaseHadirBulanSebelumnya }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9">Sakit/Izin:
                                                        {{ $dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}</div>
                                                    <div class="col-3 text-right">
                                                        {{ $persentaseSakitIzinBulanSebelumnya }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-aqua" role="progressbar"
                                                                style="width: {{ $persentaseSakitIzinBulanSebelumnya }}%"
                                                                aria-valuenow="{{ $persentaseSakitIzinBulanSebelumnya }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9">Terlambat:
                                                        {{ $dataBulanSebelumnya['Terlambat'] ?? 0 }}</div>
                                                    <div class="col-3 text-right">
                                                        {{ $persentaseTerlambatBulanSebelumnya }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-purple" role="progressbar"
                                                                style="width: {{ $persentaseTerlambatBulanSebelumnya }}%"
                                                                aria-valuenow="{{ $persentaseTerlambatBulanSebelumnya }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9">Alfa:
                                                        {{ $dataBulanSebelumnya['Alfa'] ?? 0 }}</div>
                                                    <div class="col-3 text-right">
                                                        {{ $persentaseAlfaBulanSebelumnya }}%</div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: {{ $persentaseAlfaBulanSebelumnya }}%"
                                                                aria-valuenow="{{ $persentaseAlfaBulanSebelumnya }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-15">
                                                    <div class="col-9">TAP:
                                                        {{ $dataBulanSebelumnya['TAP'] ?? 0 }}</div>
                                                    <div class="col-3 text-right">{{ $persentaseTAPBulanSebelumnya }}%
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="progress mt-2">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: {{ $persentaseTAPBulanSebelumnya }}%"
                                                                aria-valuenow="{{ $persentaseTAPBulanSebelumnya }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-9">Total
                                                        Keterlambatan:
                                                        {{ $late2 }} Menit</div>
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

        // var lokasi = document.getElementById('lokasi');
        // if (navigator.geolocation) {
        //     navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        // }

        // Output the server values to verify
        var lokasi_sekolah = "{{ $lok_sekolah->lokasi_sekolah }}";
        var radius = parseFloat("{{ $lok_sekolah->radius }}");
        console.log('lokasi_sekolah:', lokasi_sekolah);
        console.log('radius:', radius);

        function successCallback(position) {
            console.log('User coordinates:', position.coords.latitude, position.coords.longitude);
            var lat_user = position.coords.latitude;
            var long_user = position.coords.longitude;

            // Example coordinates for testing
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];

            var userLatLng = L.latLng(lat_user, long_user);
            var schoolLatLng = L.latLng(lat_sekolah, long_sekolah);

            var distance = userLatLng.distanceTo(schoolLatLng).toFixed(0);
            var distanceInKm = (distance / 1000).toFixed(2);

            document.getElementById('distance').innerText = distance + ' m';

            console.log('Distance (meters):', distance);
            console.log('Distance (km):', distanceInKm);
        }

        function errorCallback(error) {
            console.error("Error retrieving location:", error);
        }

        // Request the user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        var jam_absen = @json($jam_absen);
        var batas_absen_pulang = @json($batas_absen_pulang);

        // // disable tombol absen
        // $(document).ready(function() {
        //     // Define the times for `jam_absen` and `batas_absen_pulang` from the server-side variables
        //     const jamAbsen = "{{ $jam_absen }}";
        //     const batasAbsenPulang = "{{ $batas_absen_pulang }}";

        //     const [jamHours, jamMinutes] = jamAbsen.split(':').map(Number);
        //     const [batasHours, batasMinutes] = batasAbsenPulang.split(':').map(Number);

        //     function checkTimeAndRefresh() {
        //         const currentTime = new Date();

        //         // Create Date objects for `jam_absen` and `batas_absen_pulang`
        //         const absenTime = new Date();
        //         absenTime.setHours(jamHours);
        //         absenTime.setMinutes(jamMinutes);
        //         absenTime.setSeconds(0);

        //         const batasTime = new Date();
        //         batasTime.setHours(batasHours);
        //         batasTime.setMinutes(batasMinutes);
        //         batasTime.setSeconds(0);

        //         // Check if the current time is past `jam_absen`
        //         if (currentTime > absenTime) {
        //             if (!localStorage.getItem('pageRefreshed')) {
        //                 localStorage.setItem('pageRefreshed', 'true');
        //                 setTimeout(() => location.reload(), 1000); // Refresh after 1 second
        //             }
        //         } else {
        //             localStorage.removeItem('pageRefreshed');
        //         }

        //         // Check if the current time is past `batas_absen_pulang`
        //         if (currentTime >= batasTime) {
        //             if (!localStorage.getItem('batasRefreshed')) {
        //                 localStorage.setItem('batasRefreshed', 'true');
        //                 setTimeout(() => location.reload(), 1000); // Refresh after 1 second
        //             }
        //         } else {
        //             localStorage.removeItem('batasRefreshed');
        //         }
        //     }

        //     // Check the time immediately
        //     checkTimeAndRefresh();

        //     // Set an interval to check every 5 seconds
        //     setInterval(checkTimeAndRefresh, 5000); // Check every 5 seconds
        // });
    </script>
</body>

</html>
