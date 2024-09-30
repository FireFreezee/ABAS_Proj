@extends('layouts.header')

@section('content')
    @vite('resources/css/app.css')
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="index.html">
                <div class="flex">
                    <img src="{{ asset('assets/img/logo-abas.png') }}" style="height: auto; width: 2rem;" alt="lavalite">
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
            <h5 class="font-bold text-[20px] mb-4">
                Kehadiran Seluruh Siswa Hari Ini
            </h5>
            <div class="grid grid-cols-5 gap-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-green-500 text-lg">{{ $countHadir }}</h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">Hadir</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm2.023 6.828a.75.75 0 1 0-1.06-1.06 3.75 3.75 0 0 1-5.304 0 .75.75 0 0 0-1.06 1.06 5.25 5.25 0 0 0 7.424 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2" style="height: 6px;">
                            <div class="progress-bar bg-green-500 " role="progressbar"
                                style="width: {{ number_format($percentageHadir) }}%;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($percentageHadir) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-aqua text-lg">{{ $countSakitIzin }}</h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">Sakit/Izin</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm-4.34 7.964a.75.75 0 0 1-1.061-1.06 5.236 5.236 0 0 1 3.73-1.538 5.236 5.236 0 0 1 3.695 1.538.75.75 0 1 1-1.061 1.06 3.736 3.736 0 0 0-2.639-1.098 3.736 3.736 0 0 0-2.664 1.098Z" clip-rule="evenodd" />
                                  </svg>                                                                    
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2" style="height: 6px;">
                            <div class="progress-bar bg-aqua" role="progressbar"
                                style="width: {{ number_format($percentageSakitIzin) }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($percentageSakitIzin) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-red-700 text-lg">{{ $countAlfa }}</h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">Alfa</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                  </svg>                                                                    
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2" style="height: 6px;">
                            <div class="progress-bar bg-red-700" role="progressbar"
                                style="width: {{ number_format($percentageAlfa) }}%;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($percentageAlfa) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-400 text-lg">{{ $countTerlambat }}</h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">Terlambat</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                                  </svg>                                  
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2" style="height: 6px;">
                            <div class="progress-bar bg-gray-400" role="progressbar"
                                style="width: {{ number_format($percentageTerlambat) }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($percentageTerlambat) }}%</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h3 class="text-gray-900 text-lg">{{ $countTAP }}</h3>
                                <p class="card-subtitle text-muted fw-500 text-xl">TAP</p>
                            </div>
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                                </svg>                                  
                            </div>
                        </div>
                        <div class="progress mt-3 mb-1 !h-2" style="height: 6px;">
                            <div class="progress-bar bg-gray-900" role="progressbar"
                                style="width: {{ number_format($percentageTAP) }}%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="text-muted f12">
                            <span class="float-right">{{ number_format($percentageTAP) }}%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>
@endsection
