<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="row">
      <div class="card">
            <?php echo form_open("auth/create_user"); ?>

            <div class="card-body row mt-4">
                  <div id="infoMessage"><?php echo $message; ?></div>
                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama Depan</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($first_name); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama Terakhir</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($last_name); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-2 text-end control-label col-form-label">Instansi</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($company); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="namains" class="col-sm-2 text-end control-label col-form-label">Nomor Telepon</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($phone); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('NAMA_INS'); ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Email</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($email); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('KODE_INS'); ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="ttl" class="col-sm-2 text-end control-label col-form-label">Password</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($password); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('TLHR_ANG') ?></small>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="alamat" class="col-sm-2 text-end control-label col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($password_confirm); ?>
                              </div>
                              <small class="form-text text-danger"><?= form_error('ALM_ANG') ?></small>
                        </div>
                        <div class="col-sm-3 text-end mt-3 ">
                              <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                              <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                        </div>
                  </div>
            </div>
            <?php echo form_close(); ?>
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