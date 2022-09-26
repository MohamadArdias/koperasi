<form action="" method="POST">
    <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" placeholder="No urut anggota" /> <br>
    <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>

    <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" placeholder="Nama anggota" /> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
    
    <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" placeholder="Kode instansi" /> <br>
    <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
    
    <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS" placeholder="Nama instansi" /> <br>
    <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>

    <button type="submit" name="tambah" class="btn btn-primary">simpan</button>
</form>