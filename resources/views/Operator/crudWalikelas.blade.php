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
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content">
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
                            <h3>List Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-outline-primary btn-rounded mr-2" data-toggle="modal" data-target="#tambah">Tambah</button>
                                <button type="button" class="btn btn-outline-primary btn-rounded" data-toggle="modal" data-target="#import">Import</button>
                                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                            ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="data_table" class="table">
                                <thead>
                                    <tr>
                                        <th>NUPTK</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Email</th>
                                        <th class="nosort">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wali_kelas as $wali)
                                        <tr>
                                            <td>{{ $wali->nuptk }}</td>
                                            <td>{{ $wali->nama }}</td>
                                            <td>{{ $wali->jenis_kelamin }}</td>
                                            <td>{{ $wali->user ? $wali->user->email : 'N/A' }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="#"><i class="ik ik-eye"></i></a>
                                                    <a href="#"><i class="ik ik-edit-2"></i></a>
                                                    <a href="#"><i class="ik ik-trash-2"></i></a>
                                                </div>
                                            </td>
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
