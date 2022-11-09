<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0066ff;
        color: white;
    }
</style>

<?php

$b = $this->data['urutan'];

// KDOE
if ($kode == 1) {
    $kd = 'U';
    $bg = 1.5;
} elseif ($kode == 2) {
    $kd = 'S';
    $bg = 2;
} elseif ($kode == 3) {
    $kd = 'O';
    $bg = 0;
} elseif ($kode == 4) {
    $kd = 'N';
    $bg = 2;
} else {
    $kd = 'Z';
    $bg = 3;
}

$hari = date("d");
$bulan = date("m");
$tahun = date("y");

echo date("H:i:s");

if ($bulan == 1) {
    $a = 'A';
} elseif ($bulan == 2) {
    $a = 'B';
} elseif ($bulan == 3) {
    $a = 'C';
} elseif ($bulan == 4) {
    $a = 'D';
} elseif ($bulan == 5) {
    $a = 'E';
} elseif ($bulan == 6) {
    $a = 'F';
} elseif ($bulan == 7) {
    $a = 'G';
} elseif ($bulan == 8) {
    $a = 'H';
} elseif ($bulan == 9) {
    $a = 'I';
} elseif ($bulan == 10) {
    $a = 'J';
} elseif ($bulan == 11) {
    $a = 'K';
} else {
    $a = 'L';
}

$faktur = $tahun . $a . $kd . $urutan;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-7">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="card-body row mt-4">
                                <div class="form-group row mb-2">
                                    <label for="nama" class="col-sm-4 text-end control-label col-form-label">Faktur</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="NOFAK" class="form-control" id="NOFAK" value="<?= $faktur ?>" />
                                            <input type="hidden" name="KODE" class="form-control" id="KODE" value="<?= $kd ?>" />
                                            <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="nama" class="col-sm-4 text-end control-label col-form-label">Kode Anggota</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" onkeyup="autofill()" autofocus>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Tanggungan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="TANGGUNGAN" class="form-control" id="TANGGUNGAN">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('TANGGUNGAN'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Jumlah</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="JMLP_ANG" name="JMLP_ANG">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('JMLP_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Bunga</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" class="form-control" id="PRO_ANG" name="PRO_ANG" value="<?= $bg; ?>">
                                            <?= $bg; ?>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('PRO_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="namains" class="col-sm-4 text-end control-label col-form-label">Jangka Waktu</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="JWKT_ANG" class="form-control" id="JWKT_ANG">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('JWKT_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="Golongan" class="col-sm-4 text-end control-label col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm ">
                                            <input type="text" class="form-control" id="TGLP_ANG" name="TGLP_ANG">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('TGLP_ANG'); ?></small>
                                    </div>
                                    <div class="col-sm-6 text-end mt-3 ">
                                        <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div><!-- End Sales Card -->
            <?php date('Y-m-d', strtotime('+7 month', strtotime($a))); ?>
            <!-- Revenue Card -->

            <div class="col-xxl-4 col-md-5">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h2>Jenis Pinjaman</h2>
                        <table class="table">
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Pinjaman</th>
                                <th>Bunga</th>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>SIM</td>
                                <td>2%</td>
                            </tr>
                            <tr>
                                <td>Z</td>
                                <td>Pinjaman Khusus</td>
                                <td>3%</td>
                            </tr>
                            <tr>
                                <td>O</td>
                                <td>Konsumsi</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td>N</td>
                                <td>Non Konsumsi</td>
                                <td>2%</td>
                            </tr>
                            <tr>
                                <td>U</td>
                                <td>Uang</td>
                                <td>1.5%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div><!-- End Revenue Card -->
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    function goBack() {
        window.history.back();
    }

    $(function() {
        // $("#TGLP_ANG").datepicker({
        //     changeMonth: true,
        //     changeYear: true
        // })
        $("#TGLP_ANG").datepicker()
        $("#TGLT_ANG").datepicker()
        $("#TGLP_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
        $("#TGLT_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
        // $("#TGLK_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
    })

    function autofill() {
        var URUT_ANG = $('#URUT_ANG').val();
        var KODE = $('#KODE').val();
        $.ajax({
            url: '<?= base_url(); ?>index.php/Pinjaman/autofill',
            data: {
                'URUT_ANG': URUT_ANG,
                'KODE': KODE
            },
        }).success(
            function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $("#NAMA_ANG").val(obj.nama);

                var jang = obj.jangka;
                var per = obj.periode;
                var sis = obj.sisa;
                var bung = obj.bunga;
                var tang = (jang - per) * bung;
                $("#TANGGUNGAN").val(Number(tang) + Number(sis));          
            });
    }
</script>