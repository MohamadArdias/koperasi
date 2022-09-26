<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>


<form action="" method="POST">
    <input type="hiden" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $instansi['KODE_INS'];?>"/> <br>
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>

    <input type="text" name="NAMA_INS" placeholder="Nama Instansi" class="form-control" id="NAMA_INS" value="<?= $instansi['NAMA_INS'];?>"/> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <textarea class="form-control" placeholder="Alamat Instansi" name="ALM_INS" ><?= $instansi['ALM_INS'];?></textarea> <br>
    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>

    <input type="text" name="TLP_INS" placeholder="Nomor Telepon Instansi" class="form-control" id="TLP_INS" value="<?= $instansi['TLP_INS'];?>"/> <br>
    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>

    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
</form>



<?php
$this->load->view('templates/footer');
?>