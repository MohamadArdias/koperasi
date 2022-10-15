<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <div class="card-body mt-4">
        <div class="form-group row mb-2">
            <label for="nama" class="col-sm-2 text-end control-label col-form-label">Kode Urut</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-person-fill input-group-text"></i>
                    <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" value="<?= $anggota['URUT_ANG']; ?>" disabled>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-person-fill input-group-text"></i>
                    <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $anggota['NAMA_ANG']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Kode Instansi</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-briefcase-fill input-group-text"></i>
                    <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $anggota['KODE_INS']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="namains" class="col-sm-2 text-end control-label col-form-label">Nama Instansi</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-briefcase-fill input-group-text"></i>
                    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="-" value="<?= $anggota['NAMA_INS']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="ttl" class="col-sm-2 text-end control-label col-form-label">Tanggal Lahir</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text "></i>
                    <input type="text" class="form-control" id="TLHR_ANG" name="TLHR_ANG" placeholder="-" value="<?= $anggota['TLHR_ANG']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="alamat" class="col-sm-2 text-end control-label col-form-label">Alamat</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-geo-alt-fill input-group-text "></i>
                    <input type="text" class="form-control" id="ALM_ANG" placeholder="-" name="ALM_ANG" value="<?= $anggota['ALM_ANG']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="In" class="col-sm-2 text-end control-label col-form-label">Tanggal Masuk</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text"></i>
                    <input type="text" class="form-control" id="TGLM_ANG" placeholder="-" name="TGLM_ANG" value="<?= $anggota['TGLM_ANG']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="Out" class="col-sm-2 text-end control-label col-form-label">Tanggal Keluar</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text"></i>
                    <input type="text" class="form-control" id="TGLK_ANG" placeholder="-" name="TGLK_ANG" value="<?= $anggota['TGLK_ANG']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label for="Golongan" class="col-sm-2 text-end control-label col-form-label">Golongan</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-people-fill input-group-text"></i>
                    <input type="text" class="form-control" id="GOL" placeholder="-" name="GOL" value="<?= $anggota['GOL']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="col-sm-2 text-end mt-3 ">
            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
$this->load->view('templates/footer');
?>