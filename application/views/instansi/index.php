<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card">
    <div class="card-body">
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data Instansi <strong>Berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-3">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="input-group">
                        <div>
                            <a href="<?= base_url(); ?>index.php/Instansi/tambah" class="btn btn-primary">Tambah Instansi</a>
                        </div>
                    <div class="col"></div>
                    <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        

        <table class="table table-bordered mt-3">
            <thead class="table-primary">
                <tr>
                    <th class="text-center" >Kode Instansi</th>
                    <th class="text-center" >Nama Instansi</th>
                    <th class="text-center" >Alamat</th>
                    <th class="text-center" >Nomor Telepon</th>
                    <th class="text-center" >Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instansi as $ins) : ?>
                    <tr>
                        <td><?= $ins['KODE_INS']; ?></td>
                        <td><?= $ins['NAMA_INS']; ?></td>
                        <td><?= $ins['ALM_INS']; ?></td>
                        <td><?= $ins['TLP_INS']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url(); ?>index.php/instansi/edit/<?= $ins['KODE_INS']; ?>" class="btn btn-warning">Edit</a>
                            <a href="<?= base_url(); ?>index.php/instansi/hapus/<?= $ins['KODE_INS']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?');">Hapus</a>
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