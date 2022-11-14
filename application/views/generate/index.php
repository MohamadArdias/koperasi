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
        text-align: center;
        background-color: #0066ff;
        color: white;
    }

    #customers td {
        padding-top: 12px;
        padding-bottom: 12px;
        /* text-align: center; */
    }
</style>

<div class="card">
    <div class="card-body">
        <?php if ($this->session->flashdata('genta')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('genta') ?></strong> melakukan generate
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group">
                    <a href="<?= base_url(); ?>index.php/genta" class="btn btn-primary">Generate</a>
                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Tagihan</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $i = 1;
                    foreach ($pembayaran as $key) {
                    ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $key['TGL_TGHN']; ?></td>
                        <td><?= $key['NAMA_ANG']; ?></td>
                        <td><?= $key['NAMA_INS']; ?></td>
                        <td class="text-right"><?= number_format($key['JML_TGHN'], 0, ',', '.'); ?></td>
                        <td><?= $key['STATUS']; ?></td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>