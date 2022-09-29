<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<!-- <body> -->
<div class="card">
    <div class="card-body row mt-4">
        <div class="form-group row mb-2 ms-5">
            <label for="nama" class="from-label">Kode Anggota</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-person-fill input-group-text"></i>
                    <input type="text" name="KODE_ANG" class="form-control" id="" value="<?= $anggota['KODE_ANG']; ?>" readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="ttl" class="form-label">Nama</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-person-fill input-group-text"></i>
                    <input type="text" class="form-control" id="" name="birthday" value="<?= $anggota['NAMA_ANG']; ?>" readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="kredit" class="form-label">Limit Kredit </label>
            <div class="col-sm-9">
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" class="form-control" id="" value="" required readonly>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="nama" class="from-label">Kode Instansi</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-briefcase-fill input-group-text"></i>
                    <input type="text" class="form-control" id=" value=" value="<?= $anggota['KODE_INS']; ?>" readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="Instansi" class="from-label">Nama Instansi</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-briefcase-fill input-group-text"></i>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['NAMA_INS']; ?>" readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="ttl" class="form-label">Tempat Tanggal Lahir</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text "></i>
                    <input type="text" class="form-control" id="" name="birthday" value="<?= $anggota['TLHR_ANG']; ?>" readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="alamat" class="from-label">Alamat</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <i class="bi-geo-alt-fill input-group-text "></i>
                    <textarea class="form-control" id="floatingTextarea2" placeholder="<?= $anggota['ALM_ANG']; ?>" style="height: 100px" readonly></textarea>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="In" class="from-label">Tanggal Masuk</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text "></i>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['TGLM_ANG']; ?>" required readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="Out" class="from-label">Tanggal Keluar</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-calendar3 input-group-text "></i>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['TGLK_ANG']; ?>" required readonly>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group row mb-2 ms-5">
            <label for="Golongan" class="from-label">Golongan</label>
            <div class="col-sm-9">
                <div class="input-group ">
                    <i class="bi-people-fill input-group-text"></i>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['GOL']; ?>" required readonly>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>