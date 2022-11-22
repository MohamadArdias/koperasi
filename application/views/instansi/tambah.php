<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <?php if ($this->session->flashdata('insggl')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $this->session->flashdata('insggl'); ?></strong> Sudah di gunakan
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <div class="form-group row mb-2">
                <label for="KODE_INS" class="col-sm-2 text-end control-label col-form-label">Kode Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="NAMA_INS" class="col-sm-2 text-end control-label col-form-label">Nama Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="ALM_INS" class="col-sm-2 text-end control-label col-form-label">Alamat Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" name="ALM_INS" class="form-control" id="ALM_INS" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="TLP_INS" class="col-sm-2 text-end control-label col-form-label">Nomor Telepon</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <input type="text" name="TLP_INS" class="form-control" id="TLP_INS" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>
                </div>
                <div class="col-sm-3 text-end mt-3 ">
                    <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
$this->load->view('templates/footer');
?>