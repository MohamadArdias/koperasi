<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="input-group">
                        <div>
                            <a href="<?= base_url(); ?>index.php/Kirim/export" class="btn btn-primary"><i class="bi-download"></i> Export Excel</a>
                        </div>
                        <div class="col-sm-6"></div>
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered mt-3">
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
                        <?php
                        $potongan = $lap['WAJIB'] +
                            $lap['POKU1'] + $lap['BNGU1'] +
                            $lap['POKU2'] + $lap['BNGU2'] +
                            $lap['POKU3'] + $lap['BNGU3'] +
                            $lap['POKU4'] + $lap['BNGU4'] +
                            $lap['POKU5'] + $lap['BNGU5'] +
                            $lap['POKU6'] + $lap['BNGU6'] +
                            $lap['POKU7'] + $lap['BNGU7'] +
                            $lap['POKU8'] + $lap['BNGU8'];
                        ?>
                        <td><?= $potongan; ?></td>
                        <td><?= 'KPRI "BANGKIT BERSAMA"'; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>