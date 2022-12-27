<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

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

<div class="card">
    <form action="" method="POST">
        <div class="card-body mt-4">
            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Kode Urut</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" value="<?= $berhenti['URUT_ANG']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="nama" class="col-sm-2 text-end control-label col-form-label">Nama</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-person-fill input-group-text"></i>
                        <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $berhenti['NAMA_ANG']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Instansi</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-briefcase-fill input-group-text"></i>
                        <input type="text" name="KODE_INS" class="form-control" id="KODE_INS" value="<?= $berhenti['KODE_INS'] . '/' . $berhenti['NAMA_INS']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label for="kdins" class="col-sm-2 text-end control-label col-form-label">Status</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <i class="bi-briefcase-fill input-group-text"></i>
                        <select id="STATUS" name="STATUS" class="form-select" aria-label="Default select example">
                            <?php $bht = $this->db->query("SELECT * FROM instan WHERE instan.KODE_INS = 95 OR instan.KODE_INS = 96 OR instan.KODE_INS = 97 OR	instan.KODE_INS = 98 OR	instan.KODE_INS = 99 ")->result_array(); ?>
                            <?php foreach ($bht as $key) : ?>
                                <option value="<?= $key['KODE_INS']; ?>"><?= $key['KODE_INS']; ?>/<?= $key['NAMA_INS']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <small class="form-text text-danger"><?= form_error('STATUS'); ?></small>
                </div>
                <input type="hidden" name="TGLK_ANG" class="form-control" id="TGLK_ANG" value="<?= date("Y-m-d"); ?>" />
            </div>

            <div class="col-sm-4 text-end mt-3 ">
                <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?php
$this->load->view('templates/footer');
?>