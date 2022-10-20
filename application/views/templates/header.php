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

    <!-- Favicons -->
    <link href="<?= base_url('public'); ?>/assets/img/favicon_kop.png" rel="icon">
    <link href="<?= base_url('public'); ?>/assets/img/apple-touch-icon_kop.png" rel="apple-touch-icon_kop">

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
    <link href="<?= base_url('public'); ?>/assets/css/nav.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php date_default_timezone_set("Asia/Jakarta"); ?>
    <!-- Logo -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>index.php/" class="logo d-flex align-items-center">
                <img src="<?= base_url('public'); ?>/assets/img/logo_kop.png" alt="">
                <span class="d-none d-lg-block">KOPERASI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <!-- End Logo -->

        <!-- Profile -->

        <nav class="navbar col-md-1 ms-auto">
            <ul>
                <li><a href="">Nama</a>
                    <ul>
                        <li><a href="">Profile</a></li>
                        <li><a href="">Edit Profile</a></li>
                        <li><a href="">Log Out</a></li>
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