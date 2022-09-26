<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>


<form action="" method="POST">
    <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" placeholder="kode instansi" />
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>

    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="nama instansi" />
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <textarea class="form-control" name="ALM_INS" placeholder="alamat instansi"></textarea>
    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>
    
    <input type="text" name="TLP_INS" class="form-control" id="TLP_INS" placeholder="no telepon" />
    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>

    <button type="submit" name="tambah" class="btn btn-primary">simpan</button>
</form>



<?php
$this->load->view('templates/footer');
?>