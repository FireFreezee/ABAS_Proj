@extends('layouts.header')

@section('content')
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
                            aria-haspopup="true" aria-expanded="false"><img class="avatar"
                                src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
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
                    <div class="logo-img">
                        <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: 2rem; width: auto;"
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
                        <div class="nav-lavel">Navigation</div>
                        <div class="nav-item">
                            <a href="{{ route('Dashboard') }}"><i class="ik ik-calendar"></i><span>Setting
                                    Koordinat dan Waktu</span></a>
                        </div>
                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Data Pengguna</span></a>
                            <div class="submenu-content">
                                <a href="{{ route('data-wali') }}" class="menu-item"><i
                                        class="ik ik-users"></i><span>Tambah/Edit WaliKelas</span></a>
                                <a href="{{ route('data-kesiswaan') }}" class="menu-item"><i
                                        class="ik ik-users"></i><span>Tambah/Edit
                                        Kesiswaan</span></a>
                                <a href="{{ route('data-walsis') }}" class="menu-item"><i
                                        class="ik ik-users"></i><span>Tambah/Edit WaliSiswa</span></a>
                            </div>
                        </div>
                        <div class="nav-item">
                            <a href="{{ route('data-jurusan') }}"><i class="ik ik-award"></i><span>Tambah/Edit
                                    Jurusan</span></a>
                        </div>
                        <div class="nav-item active">
                            <a href="{{ route('data-kelas') }}"><i class="ik ik-book-open"></i><span>Tambah/Edit
                                    Kelas</span></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    onloadeddata="showSuccessToast()">
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
                                    <h5>List Kelas</h5>
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
                                        <a href="#">List Kelas</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Tabel Kelas</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>List Kelas</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-outline-primary btn-rounded mr-2"
                                        data-toggle="modal" data-target="#tambah"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                                            viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg> Tambah</button>
                                    <button type="button" class="btn btn-outline-primary btn-rounded"
                                        data-toggle="modal" data-target="#import">Import</button>


                                </div>
                                {{-- modal tambah --}}
                                <div class="modal fade" id="tambah" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterLabel">Tambah Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('add-kelas') }}" method="POST"
                                                    class="forms-sample">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Jurusan</label>
                                                        <select class="form-control" id="id_jurusan" name="id_jurusan"
                                                            required>
                                                            <option value="" hidden>Pilih</option>
                                                            @foreach ($jurusan as $j)
                                                                <option value="{{ $j->id_jurusan }}">
                                                                    {{ $j->nama_jurusan }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Nomor Kelas</label>
                                                        <input type="text" class="form-control" id="nomor_kelas"
                                                            name="nomor_kelas" placeholder="Nomor Kelas" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Wali Kelas</label>
                                                        <select class="form-control" id="nuptk" name="nuptk">
                                                            <option value="" hidden>Pilih</option>
                                                            @foreach ($walikelas as $w)
                                                                <option value="{{ $w->nuptk }}">{{ $w->user->nama }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Tingkat Kelas</label>
                                                        <select class="form-control" id="tingkat" name="tingkat"
                                                            required>
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="1">10</option>
                                                            <option value="2">11</option>
                                                            <option value="2">12</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- modal import --}}
                                <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('import-kelas') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputConfirmPassword1">File</label>
                                                        <input type="file" class="form-control" id="password"
                                                            name="import_file" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Import</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="data_table" class="table">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Walikelas</th>
                                            <th>Jumlah Siswa</th>
                                            <th class="nosort">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $k)
                                            <tr style="text-align: center;">
                                                <td>{{ $k->tingkat }} {{ $k->jurusan->id_jurusan }}
                                                    {{ $k->nomor_kelas }}
                                                </td>
                                                <td>{{ $k->walikelas->user->nama ?? 'No Wali Kelas' }}</td>
                                                <td>{{ $k->siswa_count }}</td> <!-- Display total number of siswa -->
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="{{ route('data-siswa', $k->id_kelas) }}"><i
                                                                class="ik ik-eye"></i></a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#edit{{ $k->id_kelas }}"><i
                                                                class="ik ik-edit-2"></i></a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#hapus{{ $k->id_kelas }}"><i
                                                                class="ik ik-trash-2"></i></a>
                                                    </div>

                                                </td>
                                                @include('Operator.CRUDkelasModal')
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
