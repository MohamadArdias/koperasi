<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<form action="" method="POST">
    <div class="card-body row mt-4">
        <div>
            <input type="hidden" name="JABATAN" class="form-control" id="JABATAN" value="<?= $Pengurus['JABATAN']; ?>" />
            <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
        </div>
        <div class="col-sm-4 text-end mt-3 ">
            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
            <button type="submit" name="edit" class="btn btn-primary">simpan</button>
        </div>
</form>
<?php
$this->load->view('templates/footer');
?>