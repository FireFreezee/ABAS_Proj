<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!--=============== Icon ===============-->
    <link rel="icon" href="{{ asset('assets/img/logo-abas.png') }}" type="image/x-icon" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/page-siswa2/assets/css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ionicons/dist/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/c3/c3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <title>Responsive bottom navigation</title>
</head>

<body>
    <!--=============== HEADER ===============-->
    <div class="wrapper">
        <header class="header-top" id="header" style="padding-top: 5px; padding-bottom: 5px; padding-left: 14px;">
            <nav class="nav container-fluid" style="padding-right: 100px;">
                <div class="logo-img">
                    <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: 2rem; width: auto;"
                        alt="lavalite">
                    <img src="{{ asset('assets/img/logo-title.png') }}" style="height: 2rem; width: auto;"
                        class="text" alt="lavalite">
                </div>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" style="font-size: large;">Absen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: large;">Laporan</a>
                        </li>
                    </ul>
                </div>
                <div class="top-menu d-flex align-items-center">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i>
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
                <!-- <img src="assets/img/perfil.png" alt="" class="nav__img"> -->
            </nav>
        </header>

        <div class="page-wrap">
            <!--=============== HOME ===============-->
            <div class="main-content" style="padding-left: 0px;">
                <input type="hidden" id="lokasi">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-pic mb-20">
                                <img src="{{ asset('assets/page-siswa2/img/user.jpg') }}" width="150"
                                    class="rounded-circle" alt="user">
                                <h4 class="mt-20 mb-0">John Doe</h4>
                                <a href="#">johndoe@admin.com</a>
                            </div>
                            <div class="badge badge-pill badge-dark">Dashboard</div>
                            <div class="badge badge-pill badge-dark">UI</div>
                            <div class="badge badge-pill badge-dark">UX</div>
                            <div class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="3 more">+3</div>
                        </div>
                    </div>
                </div>

                <div class="container" style="margin-left: 0px; margin-right: 0px; max-width: none;">

                    <div class="row clearfix">
                        <div class="col-3 col-md-3 col-sm-12">
                            <div class="widget bg-purple card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6>Tanggal</h6>
                                            <h5 id="date">Senin 15 September 2024</h5>
                                        </div>
                                        <div class="icon">
                                            <i class="ik ik-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-sm-12">
                            <div class="widget bg-success card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6>Jam Sekarang</h6>
                                            <h5 class="clock">
                                                <span id="jam">00</span>
                                                <span>:</span>
                                                <span id="menit">00</span>
                                                <span>:</span>
                                                <span id="detik">00</span>
                                            </h5>
                                        </div>
                                        <div class="icon">
                                            <i class="ik ik-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-sm-12">
                            <div class="widget bg-yellow card-keterangan">
                                <div class="widget-body ">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="state">
                                            <h6>Jarak dari sekolah</h6>
                                            <h5 id="distance">Jarak </h5>
                                        </div>
                                        <div class="icon">
                                            <i class="ik ik-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3 col-sm-12">
                            @if ($statusAbsen == 'Belum Absen')
                                <div class="widget card-keterangan" style="background-color: grey; color: white">
                                    <div class="widget-body ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>{{ $statusAbsen }}</h5>
                                            </div>
                                            <div class="icon">
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
                                                <h6>Status Kehadiran</h6>
                                                <h5>Sudah Pulang</h5>
                                            </div>
                                            <div class="icon">
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
                                            <h6>Absen Masuk</h6>
                                            <h4>10:10</h4>
                                        </div>
                                        <div class="icon">
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
                                            <h6>Absen Pulang</h6>
                                            <h4>10:10</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="ik ik-inbox"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $currentTime = \Carbon\Carbon::now()->format('H:i');
                        $isAbsenMasukDisabled = $currentTime < $jam_absen || $currentTime >= $batas_absen_pulang;
                        $isAbsenPulang = $statusAbsen === 'Sudah Pulang';
                    @endphp
                    <div class="row clearfix">
                        <div class="col-6 col-md-6 col-sm-12">
                            <a href="{{ route('siswa-absen') }}">
                                @if ($cek > 0)
                                    <button type="button" class="btn-absen btn-danger btn-block pb-30 pt-30"
                                        style="font-size: 65px; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled || $isAbsenPulang) background-color: gray; color: white; border: none; @endif"
                                        @if ($isAbsenMasukDisabled || $isAbsenPulang) disabled @endif><i
                                            class="ik ik-maximize"></i>&nbsp; Absen Pulang<h4>Jam Absen
                                            15:30-18:00 WIB</h4></button>
                                @else
                                    <button type="button" class="btn-absen btn-primary btn-block pb-30 pt-30"
                                        style="font-size: 65px; margin-bottom: 20px; border-radius: 10px; @if ($isAbsenMasukDisabled) background-color: gray; color: white; border: none; @endif"
                                        @if ($isAbsenMasukDisabled) disabled @endif>
                                        <i class="ik ik-maximize"></i>&nbsp; Absen Masuk<h4>Jam Absen
                                            6:10-07:00 WIB</h4></button>
                                @endif
                            </a>
                        </div>
                        <div class="col-6 col-md-6 col-sm-12">
                            @if ($cek > 0)
                                <button type="button" class="btn-absen btn-secondary btn-block pb-30 pt-30"
                                    style="font-size: 65px; margin-bottom: 20px; border-radius: 10px;" disabled><i
                                        class="ik ik-user-x"></i>&nbsp; Izin/Sakit <h4>Form Izin dan Sakit</h4>
                                </button>
                            @else
                                <a href="">
                                    <button type="button" class="btn-absen btn-info btn-block pb-30 pt-30"
                                        style="font-size: 65px; margin-bottom: 20px; border-radius: 10px;"><i
                                            class="ik ik-user-x"></i>&nbsp; Izin/Sakit <h4>Form Izin dan Sakit</h4>
                                    </button>
                                </a>
                            @endif

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
    <script src="{{ asset('assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/screenfull/dist/screenfull.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/d3/dist/d3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/js/tables.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script src="{{ asset('assets/js/timedate.js') }}"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

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
    </script>
</body>

</html>
