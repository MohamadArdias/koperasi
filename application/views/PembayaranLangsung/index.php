<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class=".d-sm-flex">
    <div class="card col-lg-8">
        <div class="col-12">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Kode Anggota</label>
                        <div class="col-sm-9">
                            <select id="KODE_INS" name="KODE_INS" class="form-select" aria-label="Default select example">
                                <option selected="">--Kode Anggota--</option>
                                <?php foreach ($kodeanggota as $key) : ?>
                                    <option value="<?= $key['KODE_ANG']; ?>"><?= $key['KODE_ANG']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" placeholder="-">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Jenis Pinjaman</label>
                        <div class="col-sm-9">
                            <select id="KODE_INS" name="KODE_INS" class="form-select" aria-label="Default select example">
                                <option selected="">--Jenis Pinjaman--</option>
                                <?php foreach ($kodeanggota as $key) : ?>
                                    <option value="<?= $key['KODE_ANG']; ?>"><?= $key['KODE_ANG']; ?>/<?= $key['NAMA_ANG']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="In" class="col-sm-3 text-end control-label col-form-label">Tanggal Pembayaran</label>
                        <div class="col-sm-9">

                            <input type="text" class="form-control" id="TGLM_ANG" placeholder="-" name="TGLM_ANG" value="">
                            <!-- <small class="form-text text-danger"><?= form_error('TGLM_ANG') ?></small> -->
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Jumlah Uang</label>
                        <div class="col-sm-9">
                            <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" placeholder="-">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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