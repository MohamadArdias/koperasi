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
                            <div class="input-group input-group-sm">
                                <input type="text" name="KODE" class="form-control" id="KODE" onkeyup="autofill2()" autofocus>
                            </div>
                            <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" placeholder="-">
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
                        <label class="col-sm-3 text-end control-label col-form-label">Tagihan</label>
                        <div class="col-sm-9">
                            <input type="text" name="TAGIHAN" class="form-control" id="TAGIHAN" placeholder="-">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 text-end control-label col-form-label">Jumlah Uang Yang dibayar</label>
                        <div class="col-sm-9">
                            <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" placeholder="-">
                        </div>
                    </div>
                    <div class="col-sm-6 text-end mt-3 ">
                        <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
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
        $("#TGLM_ANG").datepicker()
        $("#TGLM_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    })

    function autofill2() {
        var KODE = $('#KODE').val();
        $.ajax({
            url: '<?= base_url(); ?>index.php/Pay/autofill2s',
            data: {
                'KODE': KODE
            },
        }).success(
            // function(data) {
            //     var json = data,
            //         obj = JSON.parse(json);
            //     $("#NAMA_ANG").val(obj.nama);
            //     $("#TAGIHAN").val(obj.tagihan);
            // }
            
        );
    }
</script>