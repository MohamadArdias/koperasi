<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0066ff;
        color: white;
    }
</style>

<div class="card">
    <div class="card-body">
        <?php if ($this->session->flashdata('flashP')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Anggota <strong>Berhasil</strong> <?= $this->session->flashdata('flashP'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-wallet"></i>
                            </div>
                            <div class="ps-3">
                                <a href="<?= base_url(); ?>index.php/pinjaman/form/1" class="nav-link">
                                    <h6>Pinjaman Uang</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <div class="ps-3">
                                <a href="<?= base_url(); ?>index.php/pinjaman/form/2" class="nav-link">
                                    <h6>Pinjaman UUB</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div class="ps-3">
                                <a href="<?= base_url(); ?>index.php/pinjaman/form/3" class="nav-link">
                                    <h6>Konsumsi</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-dash"></i>
                            </div>
                            <div class="ps-3">
                                <a href="<?= base_url(); ?>index.php/pinjaman/form/4" class="nav-link">
                                    <h6>Non Konsumsi</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-wallet-fill"></i>
                            </div>
                            <div class="ps-3">
                                <a href="<?= base_url(); ?>index.php/pinjaman/form/5" class="nav-link">
                                    <h6>Pinjaman Khusus</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>