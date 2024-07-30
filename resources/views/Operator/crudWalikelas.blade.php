@extends('layouts.header')

@section('content')
    <div class="app-sidebar colored">
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
                        <div class="nav-item">
                            <a href="{{ route('Dashboard') }}"><i class="ik ik-calendar"></i><span>Setting
                                    Koordinat dan Waktu</span></a>
                        </div>
                        <div class="nav-item active">
                            <a href=""><i class="ik ik-users"></i><span>Tambah/Edit Walikelas</span></a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('data-kesiswaan') }}"><i class="ik ik-users"></i><span>Tambah/Edit Kesiswaan</span></a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('data-jurusan') }}"><i class="ik ik-award"></i><span>Tambah/Edit Jurusan</span></a>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('data-kelas') }}"><i class="ik ik-book-open"></i><span>Tambah/Edit Kelas</span></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" onloadeddata="showSuccessToast()">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
        @endif

        @if (Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('warning') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-inbox bg-blue"></i>
                            <div class="d-inline">
                                <h5>List Walikelas</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="../index.html"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">List Walikelas</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tabel Siswa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>List Walikelas</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-outline-primary btn-rounded mr-2" data-toggle="modal"
                                    data-target="#tambah"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg> Tambah</button>
                                <button type="button" class="btn btn-outline-primary btn-rounded" data-toggle="modal"
                                    data-target="#import">Import</button>


                            </div>
                            <table id="data_table" class="table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>NUPTK</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Kelas</th>
                                        <th>Email</th>
                                        <th class="nosort">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wali_kelas as $w)
                                        <tr style="text-align: center;">
                                            <td>{{ $w->nuptk }}</td>
                                            <td>{{ $w->user->name }}</td>
                                            <td>{{ $w->jenis_kelamin }}</td>
                                            <td>{{ $w->kelas ? $w->kelas->tingkat : 'Tanpa Kelas' }} {{ $w->kelas ? $w->kelas->jurusan->nama_jurusan : '' }}</td>
                                            <td>{{ $w->user ? $w->user->email : 'N/A' }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="#" data-toggle="modal" data-target="#edit{{$w->id}}"><i class="ik ik-edit-2"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#hapus{{ $w->id }}"><i class="ik ik-trash-2"></i></a>
                                                </div>

                                            </td>
                                            @include('Operator.CRUDwaliModal')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
