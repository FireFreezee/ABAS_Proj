<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Responsive Online Boot Store Website Design Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('assets/page-siswa/css/style.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/jvectormap/jquery-jvectormap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/c3/c3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/page-siswa/dist/css/theme.min.css') }}">
        <script src="{{ asset('assets/page-siswa/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>

</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <div class="header-1">

            <a href="#" class="logo">
                <img src="{{ asset('assets/page-siswa/image/logo-abas.png') }}" class="logo-size" alt=""> 
                <img src="{{ asset('assets/page-siswa/image/logo-title.png') }}" class="logo-size" alt="">
            </a>

            <form action="" class="search-form">
                <div id="search-btn"></div>
            </form>

            <div class="icons">
                <div id="search-btn"></div>
                <div id="login-btn" class="fas fa-user"></div>
            </div>

        </div>

        <div class="header-2 active">
            <nav class="navbar-top">
                <a href="#home">Absen</a>
                <a href="#featured">Laporan</a>
                <a href="#arrivals">Profil</a>
            </nav>
        </div>

    </header>

    <!-- header section ends -->

    <!-- bottom navbar  -->

    <nav class="bottom-navbar">
        <a href="#home" class="fas fa-home"></a>
        <a href="#featured" class="fas fa-list"></a>
        <a href="#arrivals" class="fas fa-tags"></a>
        <a href="#reviews" class="fas fa-comments"></a>
        <a href="#blogs" class="fas fa-blog"></a>
    </nav>

    <!-- login form  -->

    <div class="login-form-container">

        <div id="close-login-btn" class="fas fa-times"></div>

        <form action="">
            <h3>sign in</h3>
            <span>username</span>
            <input type="email" name="" class="box" placeholder="enter your email" id="">
            <span>password</span>
            <input type="password" name="" class="box" placeholder="enter your password" id="">
            <div class="checkbox">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me"> remember me</label>
            </div>
            <input type="submit" value="sign in" class="btn">
            <p>forget password ? <a href="#">click here</a></p>
            <p>don't have an account ? <a href="#">create one</a></p>
        </form>

    </div>

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="row">

            <div class="content">
                <h3>Selamat Datang</h3>
                <p>di Website ABAS(Aplikasi Absensi Sebelas)</p>
            </div>

            <div class="swiper books-slider swiper-initialized swiper-horizontal swiper-pointer-events">
                <a href="#" class="swiper-slide"><img src="{{ asset('assets/page-siswa/image/full-logo.png') }}" alt=""></a>
                <img src="{{ asset('assets/page-siswa/image/stand.png') }}" class="stand" alt="">
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>

        </div>

    </section>

    <!-- home section ense  -->

    <!-- icons section starts  -->

    <section class="icons-container">

        <div class="container">
            <button type="button" class="btn-absen btn-info btn-block">Absen</button>
            <div class="row clearfix">
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget bg-success card-keterangan">
                        <div class="widget-body ">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Jam Absen</h6>
                                    <h4>6:10-07:00 WIB</h4>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget bg-warning card-keterangan">
                        <div class="widget-body ">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Status Kehadiran</h6>
                                    <h4>Hadir</h4>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-inbox"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </section>

    <!-- icons section ends -->

    <!-- featured section starts  -->

    <section class="featured" id="featured">

        <h1 class="heading"> <span>Laporan Kehadiran</span> </h1>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6 style="font-size: 20px; margin-bottom: 13px;">Hadir</h6>
                                    <h2>41,410</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-thumbs-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6 style="font-size: 20px; margin-bottom: 13px;">Sakit</h6>
                                    <h2>410</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6 style="font-size: 20px; margin-bottom: 13px;">Izin</h6>
                                    <h2>41,410</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-message-square"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6 style="font-size: 20px; margin-bottom: 13px;">Alfa</h6>
                                    <h2>1,410</h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-award"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-outline-info btn-rounded btn-block">See More</button>

    </section>

    <!-- featured section ends -->

    <!-- newsletter section starts -->


    <!-- blogs section ends -->

    <!-- footer section starts  -->

    <section class="footer">

        <div class="credit"> created by <span>MD.RAZI-SHAH</span> | all rights reserved! </div>

    </section>

    <!-- footer section ends -->

    <!-- loader  -->


    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="{{ asset('assets/page-siswa/js/script.js') }}"></script>


</body>

</html>