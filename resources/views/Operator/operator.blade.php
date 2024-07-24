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
                        <a href="pages/laporan-absensi.html"><i class="ik ik-calendar"></i><span>Setting
                                Koordinat dan Waktu</span></a>
                    </div>

                </nav>
            </div>
        </div>
    </div>
    <div class="main-content">
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success')}}
            </div>
        @endif

        @if (Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('warning')}}
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
                            <form class="forms-sample">
                                <div class="row">
                                    <div class="form-group col-sm-6 ">
                                        <label for="exampleInputUsername1">Jam Masuk</label>
                                        <input type="time" class="form-control form">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Jam Pulang</label>
                                        <input type="time" class="form-control form">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="time" class="form-control form">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputConfirmPassword1">Batas Absen Pulang</label>
                                        <input type="time" class="form-control form">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                            <form class="forms-sample" action="/operator/updatelokasisekolah" method="POST">
                                @csrf
                                {{-- <div class="form-group">
                                    <label for="exampleInputPassword1">Koordinat</label>
                                    <input type="text" class="form-control" id="titik_koordinat" value="{{ $lokasi_sekolah->titik_koordinat }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Radius</label>
                                    <input type="text" class="form-control" id="jarak" value="{{ $lokasi_sekolah->jarak }}">
                                </div> --}}
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
            lokasi.value = position.coords.latitude + "," + position.coords.longtitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longtitude], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longtitude]).addTo(map);
            var circle = L.circle([-6.89033536888645, 107.55833009635417], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 200
            }).addTo(map);
        }

        function errorCallback(params) {

        }
    </script>
@endsection
