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
<div class="container">
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= form_open_multipart('Import/uploaddata') ?>
                    <div class="form-row">
                        <div class="col-4">
                            <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                        <div class="col">
                            <?= $this->session->flashdata('pesan'); ?>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-borderless datatable" id="customers">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">TANGGGAL</th>
                                <th scope="col">KODE ANGGOTA</th>
                                <th scope="col">JUMLAH TAGIHAN</th>
                                <th scope="col">JUMLAH BAYAR</th>
                                <th scope="col">BAYAR VIA</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">TUNGGAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pembayaran as $bayar) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $bayar['DATE']; ?></td>
                                    <td><?= $bayar['KODE_ANG']; ?></td>
                                    <td><?= $bayar['JML_TGHN']; ?></td>
                                    <td><?= $bayar['JML_BAYAR']; ?></td>
                                    <td><?= $bayar['VIA_BAYAR']; ?></td>
                                    <td><?= $bayar['STATUS']; ?></td>
                                    <td><?= $bayar['TUNGGAKAN']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>