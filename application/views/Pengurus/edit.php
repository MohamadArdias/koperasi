<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card">
<form action="" method="POST">
    <div class="card-body row mt-4">
        <div>
            <input type="hidden" name="" class="form-control" id="" value="" />
            <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
        </div>
        <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="NAMA" class="form-control" id="NAMA" value="" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                </div>
            </div>
        <div class="col-sm-4 text-end mt-3 ">
            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
            <button type="submit" name="edit" class="btn btn-primary">simpan</button>
        </div>
</form>
</div>
<?php
$this->load->view('templates/footer');
?>
<script>
    function goBack() {
        window.history.back();
    }
</script>