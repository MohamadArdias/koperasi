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
        <?php if ($this->session->flashdata('pinggl')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Kode Anggota</strong> <?= $this->session->flashdata('pinggl'); ?>
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
            <?php

            $que = $this->db->query("SELECT MAX(generate_date) AS TGL FROM `generate_log`  WHERE tahun = date('Y') AND bulan = date('m')")->row();

            ?>


            <div class="overflow-auto">
                <table class="table table-borderless datatable" id="customers">
                    <thead class="table-primary">
                        <tr>
                            <th style="padding-left: 20px; padding-right: 20px;" class="text-center">Tanggal</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Bunga</th>
                            <th class="text-center">Jangka</th>
                            <th class="text-center">Teler</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($us as $key) {
                        ?>
                            <tr>
                                <td><?= $key['TANGGAL']; ?></td>
                                <td><?= $key['URUT_ANG'] . '/' . $key['NAMA_ANG']; ?></td>
                                <td><?= $key['KODE_INS'] . '/' . $key['NAMA_INS']; ?></td>
                                <td align="right" ><?= number_format($key['JUMLAH'], 0, ',', '.'); ?></td>
                                <td align="right" ><?= $key['PRO']; ?></td>
                                <td align="right" ><?= $key['JANGKA']; ?></td>
                                <td ><?= $key['IDNAMA']; ?></td>
                                <td>
                                    <?php
                                    $log = $this->db->query("SELECT MAX(TGL_TGHN) AS tanggal FROM pembayaran")->row();
                                    if ($key['TANGGAL'] > $log->tanggal AND $key['STATUS_US'] == 'WAIT') {
                                    ?>
                                        <!-- <a href="<?= base_url(); ?>index.php/Pinjaman/edit/<?= $key['KODE_ANG']; ?>" class="btn btn-warning">Edit</a> -->
                                        <a href="<?= base_url(); ?>index.php/Pinjaman/off/<?= $key['NOFAK']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?');">Hapus</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>