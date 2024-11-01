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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
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
                                <a href="{{ route('walsis-dashboard') }}"
                                    class="decoration-transparent items-center group lg:text-sm bg-blue-600 p-[10px] font-semibold text-white rounded-lg flex justify-center w-[50px] h-[32px] lg:w-[80px] lg:h-[42px]">
                                    <div class="text-[10px] lg:text-[15px] text-white flex items-center">Dashboard</div>
                                </a>
                                <a href="{{ route('detail-laporan') }}"
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body ml-3">
                            <div class="profile-pic mb-20">
                                <h4 class="mt-20 mb-0">Hallo {{ Auth::user()->nama }}!</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid" style="margin-left: 0px; margin-right: 0px; max-width: none;">
                    <div class="grid {{ count($siswas) === 1 ? 'grid-cols-1' : 'md:grid-cols-2' }} gap-4">
                        @foreach ($siswas as $siswa)
                            <div class="card p-3">
                                <div class="flex justify-between col-12">
                                    <h5>{{ $siswa->user->nama }}</h5> {{-- Display student name --}}
                                    <h5>{{ $siswa->kelas->tingkat }} {{ $siswa->kelas->id_jurusan }}
                                        {{ $siswa->kelas->nomor_kelas }}</h5> {{-- Display class --}}
                                </div>
                                <div class="mt-3">
                                    @if ($siswa->statusAbsen == 'Belum Absen')
                                        <h2 class="border flex justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Hadir')
                                        <h2 class="border flex text-[#26C281] justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Sakit')
                                        <h2 class="border flex text-[#3ec5d6] justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Izin')
                                        <h2 class="border flex text-orange-400 justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Alfa')
                                        <h2 class="border flex text-[#f5365c] justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'TAP')
                                        <h2 class="border flex text-gray-900 justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Terlambat')
                                        <h2 class="border flex text-gray-700 justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @elseif ($siswa->statusAbsen == 'Sudah Pulang')
                                        <h2 class="border flex text-gray-700 justify-center px-auto py-10">
                                            {{ $siswa->statusAbsen }}
                                        </h2>
                                    @endif
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <div class="widget bg-blue card-keterangan">
                                            <div class="widget-body ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="state">
                                                        <h6 class="text-[14px] sm:text-base !font-bold mb-2">Absen Masuk</h6>
                                                        <h4 class="text-[13px] sm:text-base !mb-0">
                                                            {{ $siswa->cek->jam_masuk ?? '00:00' }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="widget bg-red card-keterangan">
                                            <div class="widget-body ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="state">
                                                        <h6 class="text-[14px] sm:text-base !font-bold mb-2">Absen Pulang</h6>
                                                        <h4 class="text-[13px] sm:text-base !mb-0">
                                                            {{ $siswa->cek->jam_pulang ?? '00:00' }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" w-full">
                                    <div class="nav-tabs grid grid-cols-2 mx-3 mt-3" id="nav-tab" role="tablist">
                                        <button class="nav-link active w-full" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#bulan_ini_{{ $siswa->nis }}" type="button"
                                            role="tab" aria-controls="nav-home" aria-selected="true">Bulan
                                            Ini</button>
                                        <button class="nav-link w-full" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#bulan_sebelumnya_{{ $siswa->nis }}" type="button"
                                            role="tab" aria-controls="nav-profile" aria-selected="false">Bulan
                                            Sebelumnya</button>
                                    </div>
                                </div>
                                <div class="tab-content mt-15" id="myTabContent">
                                    <div class="tab-pane fade show active" id="bulan_ini_{{ $siswa->nis }}"
                                        role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <div class="col-12">
                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Kehadiran:
                                                {{ $siswa->dataBulanIni['Hadir/Terlambat/TAP'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-green text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseHadirBulanIni }}%"
                                                    aria-valuenow="{{ $siswa->persentaseHadirBulanIni }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseHadirBulanIni }}%
                                                </div>
                                            </div>

                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Sakit/Izin:
                                                {{ $siswa->dataBulanIni['Sakit/Izin'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-aqua text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseSakitIzinBulanIni }}%"
                                                    aria-valuenow="{{ $siswa->persentaseSakitIzinBulanIni }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseSakitIzinBulanIni }}%
                                                </div>
                                            </div>

                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Alfa: {{ $siswa->dataBulanIni['Alfa'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-danger text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseAlfaBulanIni }}%"
                                                    aria-valuenow="{{ $siswa->persentaseAlfaBulanIni }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseAlfaBulanIni }}%
                                                </div>
                                            </div>
                                            <div class="text-lg font-semibold pt-3">
                                                Menit Keterlambatan: {{ $siswa->late ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bulan_sebelumnya_{{ $siswa->nis }}"
                                        role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <div class="col-12">
                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Kehadiran:
                                                {{ $siswa->dataBulanSebelumnya['Hadir/Terlambat/TAP'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-green text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseHadirBulanSebelumnya }}%"
                                                    aria-valuenow="{{ $siswa->persentaseHadirBulanSebelumnya }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseHadirBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Sakit/Izin:
                                                {{ $siswa->dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-aqua text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseSakitIzinBulanSebelumnya }}%"
                                                    aria-valuenow="{{ $siswa->persentaseSakitIzinBulanSebelumnya }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseSakitIzinBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <div class="text-lg font-semibold pt-3">
                                                Jumlah Alfa: {{ $siswa->dataBulanSebelumnya['Alfa'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2 !h-fit">
                                                <div class="progress-bar bg-danger text-lg" role="progressbar"
                                                    style="width: {{ $siswa->persentaseAlfaBulanSebelumnya }}%"
                                                    aria-valuenow="{{ $siswa->persentaseAlfaBulanSebelumnya }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseAlfaBulanSebelumnya }}%
                                                </div>
                                            </div>
                                            <div class="text-lg font-semibold pt-3">
                                                Menit Keterlambatan: {{ $siswa->late2 ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
</body>

</html>
