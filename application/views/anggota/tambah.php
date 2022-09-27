<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">No Urut Anggota</label>
                <div class="col-sm-9">
                    <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" placeholder="-" />
                    <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Kode Anggota</label>
                <div class="col-sm-9">
                    <input type="text" name="KODE_ANG" class="form-control" id="KODE_ANG" placeholder="-" />
                    <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" />
                    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Kode Instansi</label>
                <div class="col-sm-9">
                    <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" />
                    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="namains" class="col-sm-2 text-end control-label col-form-label">Nama Instansi</label>
                <div class="col-sm-9">
                    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="-" />
                    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="ttl" class="col-sm-2 text-end control-label col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="fa-solid fa-calendar-days input-group-text "></i>
                        <input type="text" class="form-control" id="TLHR_ANG" name="TLHR_ANG" placeholder="-">
                    </div>
                    <small class="form-text text-danger"><?= form_error('TLHR_ANG') ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="alamat" class="col-sm-2 text-end control-label col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ALM_ANG" placeholder="-" name="ALM_ANG">
                    <small class="form-text text-danger"><?= form_error('ALM_ANG') ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="In" class="col-sm-2 text-end control-label col-form-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="fa-solid fa-calendar-days input-group-text"></i>
                        <input type="text" class="form-control" id="TGLM_ANG" placeholder="-" name="TGLM_ANG">
                    </div>
                    <small class="form-text text-danger"><?= form_error('TGLM_ANG') ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="Out" class="col-sm-2 text-end control-label col-form-label">Tanggal Keluar</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="fa-solid fa-calendar-days input-group-text"></i>
                        <input type="text" class="form-control" id="TGLK_ANG" placeholder="-" name="TGLK_ANG">
                    </div>
                    <small class="form-text text-danger"><?= form_error('TGLK_ANG') ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="Golongan" class="col-sm-2 text-end control-label col-form-label">Golongan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="GOL" placeholder="-" name="GOL">
                    <small class="form-text text-danger"><?= form_error('GOL') ?></small>
                </div>
                <div class="col-sm-2 text-end mt-3 ">
                    <button type="submit" name="edit" class="btn btn-primary">simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
$this->load->view('templates/footer');
?>
<script>
    $(function() {
        $("#TLHR_ANG").datepicker({
            changeMonth: true,
            changeYear: true
        })
        $("#TGLM_ANG").datepicker()
        $("#TGLK_ANG").datepicker()
        $("#TLHR_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
        $("#TGLM_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
        $("#TGLK_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    })
</script>