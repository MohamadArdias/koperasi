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
                <form action="<?= base_url(); ?>index.php/Instansi" method="post">
                    <div class="input-group">
                        <div>
                            <a href="<?= base_url(); ?>index.php/Instansi/tambah" class="btn btn-primary">Tambah Instansi</a>
                        </div>
                        <div class="col"></div>
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                        <input type="submit" class="btn btn-primary" name="submit" value="Cari">
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-auto">
            <table class="mt-3" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Kode Instansi</th>
                        <th class="text-center">Nama Instansi</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Nomor Telepon</th>
                        <th class="text-center">Aksi</th>
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
            <div class="mt-3">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>


    <?php
    $this->load->view('templates/footer');
    ?>