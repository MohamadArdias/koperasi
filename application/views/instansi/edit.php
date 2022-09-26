<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>


<form action="" method="POST">
    <input type="hiden" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $instansi['KODE_INS'];?>"/>
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>

    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" value="<?= $instansi['NAMA_INS'];?>"/>
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <textarea class="form-control" name="ALM_INS" ><?= $instansi['ALM_INS'];?></textarea>
    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>

    <input type="text" name="TLP_INS" class="form-control" id="TLP_INS" value="<?= $instansi['TLP_INS'];?>"/>
    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>

    <button type="submit" name="tambah" class="btn btn-primary">simpan</button>
</form>



<?php
$this->load->view('templates/footer');
?>