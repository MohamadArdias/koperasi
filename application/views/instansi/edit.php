<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <input type="hidden" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $instansi['KODE_INS']; ?>" />

            <div class="form-group row mb-2">
                <label for="NAMA_INS" class="col-sm-2 text-end control-label col-form-label">Nama Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" value="<?= $instansi['NAMA_INS']; ?>" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="ALM_INS" class="col-sm-2 text-end control-label col-form-label">Alamat Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <textarea type="text" name="ALM_INS" class="form-control" id="ALM_INS"><?= $instansi['ALM_INS']; ?></textarea>
                    </div>
                    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="TLP_INS" class="col-sm-2 text-end control-label col-form-label">Telepon Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text" name="TLP_INS" class="form-control" id="TLP_INS" value="<?= $instansi['TLP_INS']; ?>" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>
                </div>
            </div>
            <div class="col-sm-4 text-end mt-3 ">
                <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                <button type="submit" name="edit" class="btn btn-primary">simpan</button>
            </div>
        </div>
    </form>
</div>

<SCript>
    function goBack () {
        window.history.back();
    }
</SCript>

<?php
$this->load->view('templates/footer');
?>