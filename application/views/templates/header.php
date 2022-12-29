<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Koperasi Bangkit</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?= base_url('public'); ?>/assets/img/favicon_kop.png" rel="icon">
    <link href="<?= base_url('public'); ?>/assets/img/apple-touch-icon_kop.png" rel="apple-touch-icon_kop">
    <link href="<?= base_url('public'); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url('public'); ?>/assets/css/nav.css" rel="stylesheet">


    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- css untuk select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jika menggunakan bootstrap4 gunakan css ini  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <!-- cdn bootstrap4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>


<body>
    <?php date_default_timezone_set("Asia/Jakarta"); ?>
    <!-- ======= Header ======= -->

    <!-- Logo -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>index.php/" class="logo d-flex align-items-center">
                <img src="<?= base_url('public'); ?>/assets/img/logo_kop.png" alt="">
                <span class="d-none d-lg-block">KOPERASI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <?php
        $user = $this->session->userdata('identity');
        $sesUser = $this->db->get_where('users', ['email' => $user])->row_array();
        ?>

        <!-- Profil -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-6">
                    <a class="nav-link nav-profile collapsed pe-5" data-toggle="collapse" data-target="#forms-nav2" aria-controls="forms-nav">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $sesUser['first_name']; ?></span>
                    </a>
                    <ul id="forms-nav2" data-bs-parent="#header-nav" class="dropdown-menu nav-content collapse position-absolute">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url(); ?>index.php">
                                <i class="bi bi-person"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url(); ?>index.php/auth/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Outs</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </header><!-- End Header -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= $title; ?></h1>

        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">