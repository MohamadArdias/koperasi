<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="row">

    <div class="card">
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data instansi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-3">
            <a href="<?= base_url(); ?>index.php/Instansi/tambah" class="btn btn-primary">Tambah Instansi</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Instansi</th>
                    <th>Instansi</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instansi as $ins) : ?>
                    <tr>
                        <td><?= $ins['KODE_INS']; ?></td>
                        <td><?= $ins['NAMA_INS']; ?></td>
                        <td><?= $ins['ALM_INS']; ?></td>
                        <td><?= $ins['TLP_INS']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>index.php/instansi/edit/<?= $ins['KODE_INS']; ?>" class="btn btn-warning">edit</a>
                            <a href="<?= base_url(); ?>index.php/instansi/hapus/<?= $ins['KODE_INS']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?');">delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>