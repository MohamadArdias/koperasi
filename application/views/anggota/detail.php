<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<body>
    <div class="card">
        <label class="position-absolute top-0 end-0"><?= $anggota['NAMA_ANG']; ?></label>
        <br>
        <label for="ttl" class="form-label"> Tempat Tanggal Lahir</label>
        <input type="text" class="form-control" id="" name="birthday" value="<?= $anggota['TLHR_ANG']; ?>" readonly>
        <br>
        <label for="kredit" class="form-label">Limit Kredit </label>
        <div class="input-group mb-3">
            <span class="input-group-text">Rp.</span>
            <input type="text" class="form-control" id="" value="" required readonly>
        </div>
        <label for="Instansi" class="from-label">Instansi</label>
        <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['NAMA_INS']; ?>" required readonly>
        <br>
        <label for="alamat" class="from-label">Alamat</label>
        <textarea class="form-control" id="floatingTextarea2" placeholder="<?= $anggota['ALM_ANG']; ?>" style="height: 100px" readonly></textarea>
        <br>
        <label for="In" class="from-label">Tanggal Masuk</label>
        <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['TGLM_ANG']; ?>" required readonly>
        <br>
        <label for="Out" class="from-label">Tanggal Keluar</label>
        <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['TGLK_ANG']; ?>" required readonly>
        <br>
        <label for="Golongan" class="from-label">Golongan</label>
        <input type="text" class="form-control" id="validationDefault01" value="<?= $anggota['GOL']; ?>" required readonly>
        <br>
    </div>
    <?php
    $this->load->view('templates/footer');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>