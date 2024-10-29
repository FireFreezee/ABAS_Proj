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
                                    <h5>List Siswa</h5>
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
                                        <a href="#">List Siswa</a>
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
                                <h3>{{ $kelas->tingkat }} {{ $kelas->jurusan->nama_jurusan }}</h3>
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
                                                <form action="{{ route('add-siswa', ['id' => $kelas->id_kelas]) }}"
                                                    method="POST" class="forms-sample">
                                                    @csrf
                                                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">NIS</label>
                                                        <input type="text" class="form-control" id="nis"
                                                            name="nis" placeholder="NIS" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">NISN</label>
                                                        <input type="text" class="form-control" id="nisn"
                                                            name="nisn" placeholder="NISN" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Nama</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="name" placeholder="Nama" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Jenis Kelamin</label>
                                                        <select class="form-control" id="jenis_kelamin"
                                                            name="jenis_kelamin" required>
                                                            <option value="" hidden>Pilih</option>
                                                            <option value="1">laki laki</option>
                                                            <option value="2">perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Nik Ayah</label>
                                                        <select class="form-control" id="nik_ayah" name="nik_ayah">
                                                            <option value="" hidden>Pilih</option>
                                                            @foreach ($waliSiswa as $wali)
                                                                @if ($wali->jenis_kelamin == 'laki laki')
                                                                    <option value="{{ $wali->nik_ayah }}">
                                                                        {{ $wali->user->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Nik Ibu</label>
                                                        <select class="form-control" id="nik_ibu" name="nik_ibu">
                                                            <option value="" hidden>Pilih</option>
                                                            @foreach ($waliSiswa as $wali)
                                                                @if ($wali->jenis_kelamin == 'perempuan')
                                                                    <option value="{{ $wali->nik_ibu }}">
                                                                        {{ $wali->user->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Nik Ibu</label>
                                                        <select class="form-control" id="nik_ibu" name="nik_ibu">
                                                            <option value="" hidden>Pilih</option>
                                                            @foreach ($waliSiswa as $wali)
                                                                <option value="{{ $wali->nik_ibu }}">
                                                                    {{ $wali->user->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Password</label>
                                                        <input type="text" class="form-control" id="password"
                                                            name="password" placeholder="Password" required>
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
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="data_table" class="table">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Email</th>
                                            <th class="nosort">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $s)
                                            <tr style="text-align: center;">
                                                <td>{{ $s->nis }}</td>
                                                <td>{{ $s->user->nama ?? 'No User' }}</td>
                                                <td>{{ $s->jenis_kelamin }}</td>
                                                <td>{{ $s->user->email ?? 'No Email' }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#edit{{ $s->id_user }}"><i
                                                                class="ik ik-edit-2"></i></a>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#hapus{{ $s->id_user }}"><i
                                                                class="ik ik-trash-2"></i></a>
                                                    </div>

                                                </td>
                                                @include('Operator.CRUDsiswaModal')
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
