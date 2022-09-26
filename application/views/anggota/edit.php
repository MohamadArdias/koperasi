<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<form action="" method="POST">
    <input type="hidden" name="URUT_ANG" placeholder="Nomor Urut Anggota" class="form-control" id="URUT_ANG" value="<?= $anggota['URUT_ANG']; ?>" /> <br>
    <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>

    <input type="text" name="NAMA_ANG" placeholder="Nama Anggota" class="form-control" id="NAMA_ANG" value="<?= $anggota['NAMA_ANG']; ?>" /> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
    
    <input type="text" name="KODE_INS" placeholder="Kode Instansi" class="form-control" id="KODE_INS"  value="<?= $anggota['KODE_INS']; ?>" /> <br>
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
    
    <input type="text" name="NAMA_INS" placeholder="Nama Instansi" class="form-control" id="NAMA_INS"  value="<?= $anggota['NAMA_INS']; ?>" /> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
</form>

<?php
$this->load->view('templates/footer');
?>