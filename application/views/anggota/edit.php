<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<body>
    <div class="card">
        <form action="" method="POST">
            <div>
                <input type="hidden" name="URUT_ANG" class="form-control" id="URUT_ANG" value="<?= $anggota['URUT_ANG']; ?>" /> <br>
                <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
            </div>
            <div>
                <label for="nama" class="from-label">Kode Anggota</label>
                <input type="text" name="KODE_ANG" class="form-control" id="KODE_ANG" placeholder="-" value="<?= $anggota['KODE_ANG']; ?>" /> <br>
                <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
            </div>
            <div>
                <label for="nama" class="from-label">Nama</label>
                <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $anggota['NAMA_ANG']; ?>" /> <br>
                <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
            </div>
            <div>
                <label for="kdins" class="from-label">Kode Instansi</label>
                <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $anggota['KODE_INS']; ?>" /> <br>
                <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
            </div>
            <div>
                <label for="namains" class="from-label">Nama Instansi</label>
                <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="-" value="<?= $anggota['NAMA_INS']; ?>" /> <br>
                <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
            </div>
            <label for="ttl" class="form-label"> Tempat Tanggal Lahir</label>
            <div class="input-group mb-3">
                <i class="fa-solid fa-calendar-days input-group-text"></i>
                <input type="text" class="form-control" id="TLHR_ANG" name="TLHR_ANG" placeholder="-" value="<?= $anggota['TLHR_ANG']; ?>">
            </div>
            <small class="form-text text-danger"><?= form_error('TLHR_ANG') ?></small>
            <div>
                <label for="alamat" class="from-label">Alamat</label>
                <input type="text" class="form-control" id="ALM_ANG" placeholder="-" name="ALM_ANG" value="<?= $anggota['ALM_ANG']; ?>"><br>
                <small class="form-text text-danger"><?= form_error('ALM_ANG') ?></small>
            </div>
            <label for="In" class="from-label">Tanggal Masuk</label>
            <div class="input-group mb-3">
                <i class="fa-solid fa-calendar-days input-group-text"></i>
                <input type="text" class="form-control" id="TGLM_ANG" placeholder="-" name="TGLM_ANG" value="<?= $anggota['TGLM_ANG']; ?>">
            </div>
            <small class="form-text text-danger"><?= form_error('TGLM_ANG') ?></small>
            <label for="Out" class="from-label">Tanggal Keluar</label>
            <div class="input-group mb-3">
                <i class="fa-solid fa-calendar-days input-group-text"></i>
                <input type="text" class="form-control" id="TGLK_ANG" placeholder="-" name="TGLK_ANG" value="<?= $anggota['TGLK_ANG']; ?>"><br>
            </div>
            <small class="form-text text-danger"><?= form_error('TGLK_ANG') ?></small>
            <div>
                <label for="Golongan" class="from-label">Golongan</label>
                <input type="text" class="form-control" id="GOL" placeholder="-" name="GOL" value="<?= $anggota['GOL']; ?>">
                <small class="form-text text-danger"><?= form_error('GOL') ?></small>
            </div>
            <br>
            <br>
            <br>
            <div class="position-absolute bottom-0 end-0 translate-middle">
                <button type="submit" name="edit" class="btn btn-primary">simpan</button>
            </div>
        </form>
    </div>
    <?php
    $this->load->view('templates/footer');
    ?>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
</body>

</html>