<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="card">
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <div>
                <input type="hidden" name="URUT_ANG" class="form-control" id="URUT_ANG" value="<?= $anggota['URUT_ANG']; ?>" />
                <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $anggota['NAMA_ANG']; ?>" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">No. Rekening</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="REKENING" class="form-control" id="REKENING" value="<?= $anggota['REKENING']; ?>" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('REKENING'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-briefcase-fill input-group-text"></i>
                        <select id="KODE_INS" name="KODE_INS" class="form-select" aria-label="Default select example">
                            <option value="<?= $anggota['KODE_INS']; ?>"><?= $anggota['KODE_INS'] ?> / <?= $anggota['NAMA_INS'] ?></option>
                            <?php foreach ($instansi as $key) : ?>
                                <option value="<?= $key['KODE_INS']; ?>" ><?= $key['KODE_INS']; ?>/<?= $key['NAMA_INS']; ?></option>
                            <?php endforeach ?>
                        </select>                    </div>
                    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="ttl" class="col-sm-2 text-end control-label col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <div class="input-group ">
                        <i class="bi-calendar3 input-group-text "></i>
                        <input type="text" class="form-control" id="TLHR_ANG" name="TLHR_ANG" value="<?= $anggota['TLHR_ANG']; ?>">
                    </div>
                    <small class="form-text text-danger"><?= form_error('TLHR_ANG') ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="alamat" class="col-sm-2 text-end control-label col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-geo-alt-fill input-group-text "></i>
                        <input type="text" class="form-control" id="ALM_ANG" name="ALM_ANG" value="<?= $anggota['ALM_ANG']; ?>">
                    </div>
                </div>
                <small class="form-text text-danger"><?= form_error('ALM_ANG') ?></small>
            </div>
			
			<div class="form-group row mb-2">
                <label for="telp" class="col-sm-2 text-end control-label col-form-label">No. Telpon</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-telephone-fill input-group-text "></i>
                        <input type="text" class="form-control" id="TELP_ANG" name="TELP_ANG" value="<?= $anggota['TELP_ANG']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4 text-end mt-3 ">
                <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
            </div>
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
    // $(function() {
    //     $("#TLHR_ANG").datepicker({
    //         changeMonth: true,
    //         changeYear: true
    //     })
    //     $("#TGLM_ANG").datepicker()
    //     $("#TGLK_ANG").datepicker()
    //     $("#TLHR_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    //     $("#TGLM_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    //     $("#TGLK_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    // })
</script>