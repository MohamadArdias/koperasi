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
$user = $this->session->userdata('identity');
$sesUser = $this->db->get_where('users', ['email' => $user])->row_array();
?>

<?php if ($this->session->flashdata('flashP')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Anggota <strong>Berhasil</strong> <?= $this->session->flashdata('flashP'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="card-body row mt-4">
                                <input type="hidden" name="id" class="form-control" id="id" value="<?= $sesUser['id'] ?>" />
                                <input type="hidden" name="first_name" class="form-control" id="first_name" value="<?= $sesUser['first_name'] ?>" />
                                <input type="hidden" name="NOFAK" class="form-control" id="NOFAK" value="<?= $edit['NOFAK'] ?>" readonly />
                                <!-- <div class="form-group row mb-2">
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                    </div>
                                </div> -->
                                <div class="form-group row mb-2">
                                    <label for="nama" class="col-sm-4 text-end control-label col-form-label">Kode Anggota</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="KODE_ANG" class="form-control" id="KODE_ANG" value="<?= $edit['KODE_ANG'] ?>" readonly>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $edit['NAMA_ANG'] ?>" readonly>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                                    </div>
                                </div>
                                <!-- <div class="form-group row mb-2">
                                    <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Tanggungan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="TANGGUNGAN" class="form-control" id="TANGGUNGAN" readonly>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('TANGGUNGAN'); ?></small>
                                    </div>
                                </div> -->
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Jumlah Pinjam</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" id="JMLP_ANG" name="JMLP_ANG" min="1" value="<?= $edit['JMLP_ANG'] ?>">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('JMLP_ANG'); ?></small>
                                    </div>
                                </div>
                                <!-- <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Uang Diterima</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="TERIMA" name="TERIMA" readonly>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('TERIMA'); ?></small>
                                    </div>
                                </div> -->
                                <div class="form-group row mb-2">
                                    <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Bunga</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="PRO_ANG" name="PRO_ANG" value="<?= $edit['PRO_ANG'] ?>">
                                            <!-- <?= $bg; ?> -->
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('PRO_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="namains" class="col-sm-4 text-end control-label col-form-label">Jangka Waktu</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="JWKT_ANG" class="form-control" id="JWKT_ANG" min="1" value="<?= $edit['JWKT_ANG'] ?>">
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('JWKT_ANG'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label for="Golongan" class="col-sm-4 text-end control-label col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm ">
                                            <input type="text" class="form-control" id="TGLP_ANG" name="TGLP_ANG" value="<?= $edit['TGLP_ANG'] ?>" readonly>
                                        </div>
                                        <small class="form-text text-danger"><?= form_error('TGLP_ANG'); ?></small>
                                    </div>
                                    <div class="col-sm-6 text-end mt-3 ">
                                        <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Sales Card -->
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>