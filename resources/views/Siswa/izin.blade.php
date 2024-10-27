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
    <link href="filepond.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- FilePond styles -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    {{-- @vite('resources/js/app.js') --}}
    @vite('resources/css/app.css')

    <title>ABAS - Izin</title>
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
                            <a class="" href="#" id="userDropdown" role="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="avatar overflow-hidden !flex !justify-center">
                                    <img class="!bg-white !h-full !max-w-fit"
                                        src="{{ asset('storage/uploads/profile/' . Auth::user()->foto) }}"
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

        <div
            class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600 lg:hidden">
            <div class="grid h-full max-w-lg grid-cols-2 mx-auto font-medium">
                <a type="button" href="{{ route('siswa-dashboard') }}"
                    class="decoration-transparent inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-2 text-blue-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
            <div class="main-content" style="padding-left: 0px;">
                @if (Session::has('failed'))
                    <script>
                        Swal.fire({
                            title: 'Gagal!',
                            text: '{{ Session::get('failed') }}',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'
                            }
                        });
                    </script>
                @endif
                <div class="col-md-12 mb-7">
                    <div class="container-fluid">
                        <div class="card">
                            <a class="flex items-center p-3 text-sm sm:text-lg gap-1" href="/siswa">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-[17px] w-[17px] sm:h-[25px] sm:w-[25px]" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                                back
                            </a>
                            <div class="card-header">
                                <h3>Izin / Sakit</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('izin-store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="lokasi" name="lokasi">
                                    <div class="flex flex-wrap">
                                        <div>
                                            <input type="hidden" id="photo_webcam" name="photo_in">
                                            <a href="#" data-toggle="modal" data-target="#modalFile">
                                                <button>
                                                    File
                                                </button>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#camera">
                                                <button id="startCamera">
                                                    Kamera
                                                </button>
                                            </a>
                                        </div>
                                        <div class="modal fade" id="modalFile" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterLabel">
                                                            Pilih File</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="w-full mb-3">
                                                            <label
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                                for="file_input">Upload file</label>
                                                            <input class="text-sm sm:text-xl" id="photo_in"
                                                                name="photo_in" type="file"
                                                                accept="image/png, image/jpeg, application/pdf">
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help">PNG, JPG or PDF.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="camera" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterLabel">
                                                            Ambil Foto</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 col-md-9">
                                                            <!-- Placeholder untuk Webcam -->
                                                            <div id="my_camera"
                                                                style="border: 2px solid #ddd; border-radius: 10px; width: 320px; height: 240px;">
                                                            </div>
                                                            <!-- Tempat untuk menampilkan hasil foto -->
                                                            <img id="result"
                                                                style="display:none; margin-top: 10px;" />
                                                            <!-- Tombol untuk mengambil gambar -->
                                                            <button type="button" class="btn btn-primary mt-2"
                                                                onclick="ambilFoto()">Ambil Foto</button>
                                                            <!-- Tombol untuk mengambil ulang gambar -->
                                                            <button type="button" class="btn btn-warning mt-2"
                                                                onclick="ambilUlang()">Ambil Ulang</button>
                                                            <!-- Input tersembunyi untuk menyimpan base64 dari gambar -->
                                                            <input type="hidden" id="photo_webcam"
                                                                name="photo_webcam">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full">
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
                                                <div class="col-4 col-md-4 col-sm-12 flex justify-end w-full">
                                                    <button type="submit"
                                                        class="btn-absen btn-primary text-xs sm:text-lg w-auto justify-center px-2 bg-blue-500"
                                                        style="border-radius: 10px; padding:7px;">
                                                        <i class="ik ik-maximize"></i>Submit
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="{{ asset('assets/dist/js/theme.min.js') }}"></script>
    <script>
        // Inisialisasi Webcam
        function startWebcam() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90,
                flip_horiz: false // Nonaktifkan mirroring kamera
            });
            Webcam.attach('#my_camera'); // Menampilkan kamera di div dengan id 'my_camera'
        }

        // Ketika modal kamera ditampilkan, jalankan fungsi startWebcam
        $('#camera').on('shown.bs.modal', function(e) {
            startWebcam();
        });

        // Ketika modal ditutup, hentikan kamera
        $('#camera').on('hidden.bs.modal', function(e) {
            Webcam.reset(); // Menonaktifkan dan menghentikan kamera
        });

        // Fungsi untuk mengambil gambar
        function ambilFoto() {
            Webcam.snap(function(data_uri) {
                // Tampilkan gambar di elemen <img> dengan id 'result'
                document.getElementById('result').src = data_uri;
                document.getElementById('result').style.display = 'block';

                // Simpan data image dalam input tersembunyi untuk dikirim ke server
                document.getElementById('photo_webcam').value = data_uri;

                // Sembunyikan tampilan kamera
                document.getElementById('my_camera').style.display = 'none';
            });
        }

        // When form is submitted, set the value of photo_in based on the webcam capture
        $('form').on('submit', function() {
            var webcamImage = document.getElementById('photo_webcam').value;
            if (webcamImage) {
                // If the image is taken from the webcam, make sure to include it as photo_in
                $('input[name="photo_in"]').val(webcamImage);
            }
        });

        // Fungsi untuk mengulang mengambil foto
        function ambilUlang() {
            // Reset gambar dan tampilkan kembali kamera
            document.getElementById('result').style.display = 'none';
            document.getElementById('my_camera').style.display = 'block';
        }
    </script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );

        // Select the file input and use FilePond
        FilePond.create(document.querySelector('input[id="photo_in"]'), {
            server: {
                process: {
                    url: '{{ route('file-upload') }}', // Define the correct route here
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                revert: null,
                restore: null,
                load: null,
                fetch: null,
            },
            allowImagePreview: true,
            imagePreviewHeight: 170,
            credits: false
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
