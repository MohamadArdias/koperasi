<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>


<form action="" method="POST">
    <label for="KODE_INS" class="">Kode Instansi</label>
    <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" placeholder="Kode Instansi" /> <br>
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>

    <label for="NAMA_INS" class="">Nama Instansi</label>
    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="Nama Instansi" /> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <label for="ALM_INS" class="">Alamat Instansi</label>
    <textarea class="form-control" name="ALM_INS" placeholder="Alamat Instansi"></textarea> <br>
    <small class="form-text text-danger"><?= form_error('ALM_INS'); ?></small>
    
    <label for="TLP_INS" class="">Nomor Telepon</label>
    <input type="text" name="TLP_INS" class="form-control" id="TLP_INS" placeholder="Nomor Telepon" /> <br>
    <small class="form-text text-danger"><?= form_error('TLP_INS'); ?></small>

    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
</form>
<!-- 
<div class="card">
    <form action="" method="POST">
        <div class="card-body row mt-4">
            <div class="form-group row mb-2">
                <label for="KODE_INS" class="col-sm-2 text-end control-label col-form-label">Kode Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" placeholder="-" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-sm">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="-" />
                    </div>
                    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
                </div>
            </div> -->


<?php
$this->load->view('templates/footer');
?>