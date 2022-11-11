<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="card">
    <?php if ($this->session->flashdata('addAng')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $this->session->flashdata('addAng'); ?></strong> Sudah di gunakan
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">No Urut Anggota</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" placeholder="-" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" placeholder="-" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-briefcase-fill input-group-text"></i>
                        <select id="KODE_INS" name="KODE_INS" class="form-select" aria-label="Default select example">
                            <option selected="">--Pilih Instansi--</option>
                            <?php foreach ($instansi as $key) : ?>
                                <option value="<?= $key['KODE_INS']; ?>"><?= $key['KODE_INS']; ?>/<?= $key['NAMA_INS']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <!-- <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" placeholder="-" /> -->
                    </div>
                    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="ttl" class="col-sm-2 text-end control-label col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-calendar3 input-group-text "></i>
                        <input type="text" class="form-control" id="TLHR_ANG" name="TLHR_ANG" placeholder="-">
                    </div>
                    <!-- <small class="form-text text-danger"><?= form_error('TLHR_ANG') ?></small> -->
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="alamat" class="col-sm-2 text-end control-label col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-geo-alt-fill input-group-text"></i>
                        <input type="text" class="form-control" id="ALM_ANG" placeholder="-" name="ALM_ANG">
                    </div>
                    <!-- <small class="form-text text-danger"><?= form_error('ALM_ANG') ?></small> -->
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="In" class="col-sm-2 text-end control-label col-form-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-calendar3 input-group-text"></i>
                        <input type="text" class="form-control" id="TGLM_ANG" placeholder="-" name="TGLM_ANG">
                    </div>
                    <!-- <small class="form-text text-danger"><?= form_error('TGLM_ANG') ?></small> -->
                </div>
                <div class="col-sm-3 text-end mt-3 ">
                    <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>

            <!-- <div class="form-group row mb-2">
                <label for="Out" class="col-sm-2 text-end control-label col-form-label">Tanggal Keluar</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-calendar3 input-group-text"></i>
                        <input type="text" class="form-control" id="TGLK_ANG" placeholder="-" name="TGLK_ANG">
                    </div>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="Golongan" class="col-sm-2 text-end control-label col-form-label">Golongan</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm ">
                        <i class="bi-people-fill input-group-text"></i>
                        <input type="text" class="form-control" id="GOL" placeholder="-" name="GOL">
                    </div>
                    <small class="form-text text-danger"><?= form_error('GOL') ?></small>
                </div>
                <div class="col-sm-3 text-end mt-3 ">
                    <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                </div>
            </div> -->
        </div>
    </form>
</div>

<?php
$this->load->view('templates/footer');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function goBack() {
        window.history.back();
    }

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