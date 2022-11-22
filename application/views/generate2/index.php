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
        <?php if ($this->session->flashdata('simpanGen')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('simpanGen') ?></strong> melakukan generate
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group">
                    <a href="<?= base_url(); ?>index.php/genta/simpan" class="btn btn-primary">Generate</a>
                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th>TAHUN</th>
                        <th>BULAN</th>
                        <th>ANGGOTA</th>
                        <th>INSTANSI</th>
                        <th>WAJIB</th>
                        <th>POKOK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($simpan as $key) {
                    ?>
                        <tr>
                            <td><?= $key['TAHUN']; ?></td>
                            <td><?= $key['BULAN']; ?></td>
                            <td><?= $key['URUT_ANG'] . '/ ' . $key['NAMA_ANG']; ?></td>
                            <td><?= $key['KODE_INS'] . '/ ' . $key['NAMA_INS']; ?></td>
                            <td><?= $key['WAJIB']; ?></td>
                            <td><?= $key['POKOK']; ?></td>
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