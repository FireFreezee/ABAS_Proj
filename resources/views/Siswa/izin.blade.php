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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- FilePond styles -->
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />
    @vite('resources/js/app.js')

    <title>ABAS - Izin</title>
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
                            <a class="nav-link active" href="/siswa" style="font-size: large;">Absen</a>
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
                @if (Session::get('error'))
                    <script>
                        Swal.fire({
                            title: "Gagal",
                            text: {{ session[1] }},
                            icon: "error"
                        });
                    </script>
                @endif
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3>Izin / Sakit</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('izin-store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" id="lokasi" name="lokasi">
                                        <div class="col">
                                            <input type="file" data-max-file-size="10MB" data-max-files="3"
                                                id="photo_in" name="photo_in">
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                                            </div>
                                            <div class="form-radio mb-30">
                                                <form>
                                                    <div class="radio radiofill radio-info radio-inline">
                                                        <label>
                                                            <input type="radio" id="status" name="status"
                                                                value="Sakit" checked="checked">
                                                            <i class="helper"></i>Sakit
                                                        </label>
                                                    </div>
                                                    <div class="radio radiofill radio-warning radio-inline">
                                                        <label>
                                                            <input type="radio" id="status" name="status"
                                                                value="Izin" checked="checked">
                                                            <i class="helper"></i>Izin
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="row clearfix pt-15">
                                                <div class="col-4 col-md-4 col-sm-12"></div>
                                                <div class="col-4 col-md-4 col-sm-12"></div>
                                                <div class="col-4 col-md-4 col-sm-12">
                                                    <button type="submit" class="btn-absen btn-primary btn-block"
                                                        style="border-radius: 10px; padding:7px; font-size: 20px ">
                                                        <i class="ik ik-maximize"></i>&nbsp;Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <!-- FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <!-- FilePond plugin for file validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
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

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );

        // Select the file input and use FilePond
        const inputElement = document.querySelector('input[type=""]');
        const pond = FilePond.create(inputElement, {
            allowMultiple: false,
            maxFileSize: '10MB',
            acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'],
            name: 'photo_in', // Ensure name is properly set for multiple files
            server: {
                process: {
                    url: '/izin/store', // Adjust this to your Laravel route
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    onload: (response) => console.log(response),
                    onerror: (response) => console.error(response),
                },
            }
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }


        function successCallback(position) {
            var lokasi = document.getElementById('lokasi');
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
        }

        function errorCallback(params) {

        }
    </script>

</body>

</html>
