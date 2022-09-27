<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('public'); ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url('public'); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('public'); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('public'); ?>/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>index.php/" class="logo d-flex align-items-center">
                <img src="<?= base_url('public'); ?>/assets/img/logo.png" alt="">

                <span class="d-none d-lg-block">KOPERASI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Pencarian" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Kamu memiliki 4 notifikasi baru
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat semua</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Data Instansi berhasil ditambahkan</h4>
                                <p>Tapi boong</p>
                                <p>30 menit yang lalu</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Profil anda berhasil diubah</h4>
                                <p>Telah diubah menjadi sukses</p>
                                <p>1 jam yang lalu</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Data Anggota berhasil dihapus</h4>
                                <p>Telah dihapus dosa-dosanya</p>
                                <p>2 jam yang lalu</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Data Anggota berhasil diubah</h4>
                                <p>Data Alga Saputra telah diubah pada bagian Tempat Tanggal Lahir</p>
                                <p>4 jam yang lalu</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Tampilkan semua notifikasi</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            Kamu memiliki 3 pesan baru
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat semua</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="<?= base_url('public'); ?>/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Moh. Ardias Ade Aga</h4>
                                    <p>Hello World!</p>
                                    <p>4 jam yang lalu</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="<?= base_url('public'); ?>/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Alga Saputra</h4>
                                    <p>P!</p>
                                    <p>6 jam yang lalu</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="<?= base_url('public'); ?>/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Afdal Zikri</h4>
                                    <p>Hi!</p>
                                    <p>8 jam yang lalu</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Tampilkan semua pesan</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('public'); ?>/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Ahmad Sujono</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Ahmad Sujono</h6>
                            <span>Pegawai</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Profil saya</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Bantuan</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= $title; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">