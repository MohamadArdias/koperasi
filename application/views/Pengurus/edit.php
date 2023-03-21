<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card">
    <form action="" method="POST">

            <div class="card-body row mt-4">
                <div>
                    <input type="hidden" name="" class="form-control" id="" value="<?= $pengurus['ID']; ?>" />
                </div>
                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-2 text-end control-label col-form-label">Ketua</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <i class="bi-person-fill input-group-text"></i>
                            <input type="text" name="KETUA" class="form-control" id="KETUA" value="<?= $pengurus['KETUA']; ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('KETUA'); ?></small>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-2 text-end control-label col-form-label">Wakil</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <i class="bi-person-fill input-group-text"></i>
                            <input type="text" name="WAKIL" class="form-control" id="WAKIL" value="<?= $pengurus['WAKIL']; ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('WAKIL'); ?></small>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-2 text-end control-label col-form-label">Bendahara 1</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <i class="bi-person-fill input-group-text"></i>
                            <input type="text" name="BENDAH1" class="form-control" id="BENDAH1" value="<?= $pengurus['BENDAH1']; ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('BENDAH1'); ?></small>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-2 text-end control-label col-form-label">Bendahara 2</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <i class="bi-person-fill input-group-text"></i>
                            <input type="text" name="BENDAH2" class="form-control" id="BENDAH2" value="<?= $pengurus['BENDAH2']; ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('BENDAH2'); ?></small>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="nama" class="col-sm-2 text-end control-label col-form-label">Rekening</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <i class="bi-person-fill input-group-text"></i>
                            <input type="text" name="REKENING" class="form-control" id="REKENING" value="<?= $pengurus['REKENING']; ?>" />
                        </div>
                        <small class="form-text text-danger"><?= form_error('REKENING'); ?></small>
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