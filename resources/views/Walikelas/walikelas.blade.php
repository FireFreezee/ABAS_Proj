@extends('layouts.header')

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
                    <a href="index.html"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>
                <div class="nav-lavel">UI Element</div>
                <div class="nav-item">
                    <a href="pages/list-siswa.html"><i class="ik ik-inbox"></i><span>Daftar
                            Siswa</span></a>
                </div>
                <div class="nav-item">
                    <a href="pages/laporan-absensi.html"><i class="ik ik-calendar"></i><span>Laporan
                            Absensi</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Siswa Hadir</h6>
                                <h2>33</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-award"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="62"
                            aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Siswa Izin</h6>
                                <h2>1</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-thumbs-up"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="78"
                            aria-valuemin="0" aria-valuemax="100" style="width: 3%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Siswa Alfa</h6>
                                <h2>1</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="31"
                            aria-valuemin="0" aria-valuemax="100" style="width: 3%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Siswa Terlambat</h6>
                                <h2>1</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-message-square"></i>
                            </div>
                        </div>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 3%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-12">
                                <h3 class="card-title">Visitors By Countries</h3>
                                <div id="visitfromworld" style="width:100%; height:350px">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <div>
                                                    <div id="lang-dt_wrapper"
                                                        class="dataTables_wrapper dt-bootstrap4">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="dataTables_length"
                                                                    id="lang-dt_length"><label></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <div id="lang-dt_filter"
                                                                    class="dataTables_filter">
                                                                    <label>Search:<input type="search"
                                                                            class="form-control form-control-sm"
                                                                            placeholder=""
                                                                            aria-controls="lang-dt"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <table id="lang-dt"
                                                                    class="table table-striped table-bordered nowrap dataTable"
                                                                    role="grid"
                                                                    aria-describedby="lang-dt_info">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th class="sorting_asc"
                                                                                tabindex="0"
                                                                                aria-controls="lang-dt"
                                                                                rowspan="1"
                                                                                colspan="1"
                                                                                aria-sort="ascending"
                                                                                aria-label="Hadir: activate to sort column descending"
                                                                                style="width: 43.2812px;">
                                                                                Hadir</th>
                                                                            <th class="sorting"
                                                                                tabindex="0"
                                                                                aria-controls="lang-dt"
                                                                                rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Izin: activate to sort column ascending"
                                                                                style="width: 28.5px;">Izin
                                                                            </th>
                                                                            <th class="sorting"
                                                                                tabindex="0"
                                                                                aria-controls="lang-dt"
                                                                                rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Alfa: activate to sort column ascending"
                                                                                style="width: 34.0312px;">
                                                                                Alfa</th>
                                                                            <th class="sorting"
                                                                                tabindex="0"
                                                                                aria-controls="lang-dt"
                                                                                rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Terlambat: activate to sort column ascending"
                                                                                style="width: 76.2812px;">
                                                                                Terlambat</th>
                                                                            <th class="sorting"
                                                                                tabindex="0"
                                                                                aria-controls="lang-dt"
                                                                                rowspan="1"
                                                                                colspan="1"
                                                                                aria-label="Tanggal: activate to sort column ascending"
                                                                                style="width: 61.2344px;">
                                                                                Tanggal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>



                                                                        <tr role="row" class="odd">
                                                                            <td class="sorting_1">30</td>
                                                                            <td>3</td>
                                                                            <td>2</td>
                                                                            <td>1</td>
                                                                            <td>05/06/2024</td>
                                                                        </tr>
                                                                        <tr role="row" class="even">
                                                                            <td class="sorting_1">33</td>
                                                                            <td>1</td>
                                                                            <td>1</td>
                                                                            <td>2</td>
                                                                            <td>03/06/2024</td>
                                                                        </tr>
                                                                        <tr role="row" class="odd">
                                                                            <td class="sorting_1">33</td>
                                                                            <td>1</td>
                                                                            <td>0</td>
                                                                            <td>0</td>
                                                                            <td>04/06/2024</td>
                                                                        </tr>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th rowspan="1"
                                                                                colspan="1">Hadir</th>
                                                                            <th rowspan="1"
                                                                                colspan="1">Izin</th>
                                                                            <th rowspan="1"
                                                                                colspan="1">Alfa</th>
                                                                            <th rowspan="1"
                                                                                colspan="1">Terlambat
                                                                            </th>
                                                                            <th rowspan="1"
                                                                                colspan="1">Tanggal</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-5">
                                                                <div class="dataTables_info"
                                                                    id="lang-dt_info" role="status"
                                                                    aria-live="polite">Showing 1 to 3 of 3
                                                                    entries</div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-7">
                                                                <div class="dataTables_paginate paging_simple_numbers"
                                                                    id="lang-dt_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button page-item previous disabled"
                                                                            id="lang-dt_previous"><a
                                                                                href="#"
                                                                                aria-controls="lang-dt"
                                                                                data-dt-idx="0"
                                                                                tabindex="0"
                                                                                class="page-link">Previous</a>
                                                                        </li>
                                                                        <li
                                                                            class="paginate_button page-item active">
                                                                            <a href="#"
                                                                                aria-controls="lang-dt"
                                                                                data-dt-idx="1"
                                                                                tabindex="0"
                                                                                class="page-link">1</a>
                                                                        </li>
                                                                        <li class="paginate_button page-item next disabled"
                                                                            id="lang-dt_next"><a
                                                                                href="#"
                                                                                aria-controls="lang-dt"
                                                                                data-dt-idx="2"
                                                                                tabindex="0"
                                                                                class="page-link">Next</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="row mb-15">
                    <div class="col-9">Siswa Hadir</div>
                    <div class="col-3 text-right">90%</div>
                    <div class="col-12">
                        <div class="progress progress-sm mt-5">
                            <div class="progress-bar bg-green" role="progressbar" style="width: 90%"
                                aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-15">
                    <div class="col-9">Siswa Izin</div>
                    <div class="col-3 text-right">1%</div>
                    <div class="col-12">
                        <div class="progress progress-sm mt-5">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 3%"
                                aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-15">
                    <div class="col-9">Siswa Alfa</div>
                    <div class="col-3 text-right">1%</div>
                    <div class="col-12">
                        <div class="progress progress-sm mt-5">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 3%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">Siswa Terlambat</div>
                    <div class="col-3 text-right">1%</div>
                    <div class="col-12">
                        <div class="progress progress-sm mt-5">
                            <div class="progress-bar bg-aqua" role="progressbar" style="width: 3%"
                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection