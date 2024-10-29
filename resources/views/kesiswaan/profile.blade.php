@extends('layouts.header')

@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet" />
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
                            <a class="dropdown-item" href="{{ route('walikelas-profile') }}"><i
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
                        <div class="nav-item active">
                            <a href="{{ route('kesiswaan.index') }}"><i
                                    class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                        </div>
                        <div class="nav-lavel">Laporan</div>
                        <div class="nav-item">
                            <a href="{{ route('kesiswaan.kelas') }}"><i class="ik ik-inbox"></i><span>Laporan
                                    Absensi</span></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="container-fluid">
                <div class="card-header">
                    <div class="flex flex-wrap justify-between w-full gap-3">
                        <h3 class="text-xs!">Profile</h3>
                    </div>
                </div>
                <form action={{ route('kesiswaan-edit-profil') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value={{ Auth::user()->id }}>
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
                    <div class="card-body">
                        <div class="profile-pic mb-20">
                            <div class="flex justify-center">
                                <div
                                    class="rounded-circle !overflow-hidden !h-[100px] !w-[100px] sm:!h-[150px] sm:!w-[150px] !flex !justify-center hover:brightness-50">
                                    <div class="group-hover:block absolute top-14">
                                        <h4 class="flex justify-center items-center text-white ">
                                            Ganti Profile
                                        </h4>
                                    </div>
                                    <a href="#" data-toggle="modal" data-target="#edit{{ Auth::user()->id }}">
                                        <img src="{{ asset('storage/uploads/profile/' . Auth::user()->foto) }}"
                                            alt="Foto Profil" class="z-10">
                                    </a>
                                </div>
                                <div class="modal fade" id="edit{{ Auth::user()->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterLabel">
                                                    Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="flex justify-center">
                                                    <input type="file" class="sm:h-[300px] sm:w-[300px]"
                                                        id="photo" name="profile" accept="image/png, image/jpeg,"
                                                        value="{{ asset('storage/uploads/profile/' . Auth::user()->foto) }}" />
                                                </div>
                                                <button type="submit"
                                                    class="btn-absen btn-primary text-xs sm:text-lg w-full justify-center px-2 bg-blue-500"
                                                    style="border-radius: 10px; padding:7px;">
                                                    <i class="ik ik-maximize"></i>Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h4 class="mt-20 mb-0">{{ Auth::user()->nama }}</h4>
                                <a href="#" style="text-decoration: none">{{ Auth::user()->wali->nip }}</a>
                            </div>
                        </div>
                        <div class="">
                            <div>
                                <label for="Nama"
                                    class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" id="first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ Auth::user()->nama }}" disabled />
                            </div>
                            <div>
                                <label for="NIS"
                                    class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                                <input type="text" id="NIP"
                                    class="bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ Auth::user()->wali->nip }}" disabled />
                            </div>
                            <div>
                                <label for="NIS"
                                    class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">NUPTK</label>
                                <input type="text" id="NUPTK"
                                    class="bg-gray-50 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ Auth::user()->wali->nuptk }}" disabled />
                            </div>
                            <div>
                                <label for="Email"
                                    class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="Email" id="Email" name="email" value="{{ Auth::user()->email }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="password"
                                        class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Ganti
                                        Password</label>
                                    <input type="password" id="password" name="password"
                                        placeholder="masukkan password baru"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                        Password</label>
                                    <input type="password" id="kpassword" name="kPassword"
                                        placeholder="masukkan password baru"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="flowbite.com" />
                                </div>
                            </div>
                            <div class="flex justify-end w-full mt-3">
                                <button type="submit"
                                    class="btn-absen btn-primary text-xs sm:text-lg w-full justify-center px-2 bg-blue-500"
                                    style="border-radius: 10px; padding:7px;">
                                    <i class="ik ik-maximize"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
        </script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js">
        </script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
        </script>
        <script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js">
        </script>
        <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script>
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
                FilePondPluginImageEdit
            );

            // Select the file input and use
            // create() to turn it into a pond
            FilePond.create(document.querySelector('input[id="photo"]'), {
                server: {
                    process: {
                        url: '{{ route('kesiswaan-update-profile') }}', // Define the correct route here
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
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleProgressIndicatorPosition: 'right bottom',
                styleButtonRemoveItemPosition: 'left bottom',
                styleButtonProcessItemPosition: 'right bottom',

            });
        </script>
    @endsection
