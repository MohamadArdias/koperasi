<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="row">
      <div class="card">
            <?php echo form_open(uri_string()); ?>

            <div class="card-body row mt-4">
                  <div id="infoMessage"><?php echo $message; ?></div>
                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-3 text-end control-label col-form-label">Nama Depan</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($first_name); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-3 text-end control-label col-form-label">Nama Terakhir</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($last_name); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="nama" class="col-sm-3 text-end control-label col-form-label">Instansi</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($company); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="namains" class="col-sm-3 text-end control-label col-form-label">Nomor Telepon</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($phone); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="ttl" class="col-sm-3 text-end control-label col-form-label">Password</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($password); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <label for="alamat" class="col-sm-3 text-end control-label col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                              <div class="input-group input-group-sm">
                                    <?php echo form_input($password_confirm); ?>
                              </div>
                        </div>
                  </div>

                  <div class="form-group row mb-2">
                        <?php if ($this->ion_auth->is_admin()) : ?>

                              <label for="alamat" class="col-sm-3 text-end control-label col-form-label">Grup</label>
                              <div class="col-sm-9">
                                    <?php foreach ($groups as $group) : ?>
                                          <label class="form-check">
                                                <input type="checkbox" class="form-check-input" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
                                                <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                          </label>
                                    <?php endforeach ?>
                              </div>

                        <?php endif ?>

                        <div class="col-sm-3 text-end mt-3 ">
                              <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                              <button type="submit" name="edit" class="btn btn-primary">simpan</button>
                        </div>
                  </div>
            </div>

            <?php echo form_hidden('id', $user->id); ?>
            <?php echo form_hidden($csrf); ?>
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