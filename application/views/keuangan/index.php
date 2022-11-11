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
        background-color: #0066ff
;
        color: white;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="input-group">
                        <div>
                            <a href="<?= base_url(); ?>index.php/keuangan/export" class="btn btn-primary"><i class="bi-download"></i> Export Excel</a>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-auto">
        <table class="table table-borderless datatable" id="customers">
            <thead class="table-primary">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama Anggota</th>
                    <th class="text-center">Instansi</th>
                    <th class="text-center">Potongan</th>
                    <th class="text-center">Nama Koperasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($keuangan as $lap) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td class="text-center"><?= $lap['KODE_ANG']; ?></td>
                        <td><?= $lap['NAMA_ANG']; ?></td>
                        <td><?= $lap['NAMA_INS']; ?></td>                        
                        <td><?= $lap['JML_TGHN']; ?></td>
                        <td><?= 'KPRI "BANGKIT BERSAMA"'; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>