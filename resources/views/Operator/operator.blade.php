@extends('layouts.header')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@section('content')
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                <div class="logo-img">
                    <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: 2rem; width: auto;" alt="lavalite">
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
                    <div class="nav-lavel">Navigation</div>
                    <div class="nav-item active">
                        <a href=""><i class="ik ik-calendar"></i><span>Setting
                                Koordinat dan Waktu</span></a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('data-wali') }}"><i class="ik ik-users"></i><span>Tambah/Edit Walikelas</span></a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('data-jurusan') }}"><i class="ik ik-users"></i><span>Tambah/Edit Jurusan</span></a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('data-kelas') }}"><i class="ik ik-users"></i><span>Tambah/Edit Kelas</span></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="main-content">
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('warning') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3>Setting Waktu</h3>
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('updatewaktu') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputUsername1">Jam Masuk</label>
                                        <input type="time" class="form-control form" id="jam_absen" name="jam_absen"
                                            value="{{ $waktu->jam_absen }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Jam Pulang</label>
                                        <input type="time" class="form-control form" id="jam_pulang" name="jam_pulang"
                                            value="{{ $waktu->jam_pulang }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Batas Absen Masuk</label>
                                        <input type="time" class="form-control form" id="batas_absen_masuk"
                                            name="batas_absen_masuk" value="{{ $waktu->batas_absen_masuk }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputConfirmPassword1">Batas Absen Pulang</label>
                                        <input type="time" class="form-control form" id="batas_absen_pulang"
                                            name="batas_absen_pulang" value="{{ $waktu->batas_absen_pulang }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="lokasi">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3>Setting Koordinat</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div id="map"></div>
                                </div>
                            </div>
                            <form class="forms-sample" action="{{ route('updatelokasi') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Koordinat</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                              </svg></i></label>
                                        </span>
                                        <input type="text" class="form-control" id="lokasi_sekolah" name="lokasi_sekolah"
                                            value="{{ $lok_sekolah->lokasi_sekolah }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Radius</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-broadcast" viewBox="0 0 16 16">
                                                <path d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0"/>
                                              </svg></i></label>
                                        </span>
                                        <input type="text" class="form-control" id="radius" name="radius"
                                            value="{{ $lok_sekolah->radius }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }


        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var lokasi_sekolah = "{{ $lok_sekolah->lokasi_sekolah }}";
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var map = L.map('map').setView([lat_sekolah, long_sekolah], 17);
            var radius = "{{ $lok_sekolah->radius }}"
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([lat_sekolah, long_sekolah]).addTo(map);
            var circle = L.circle([lat_sekolah, long_sekolah], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback(params) {

        }
    </script>
@endsection
