<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="row">

    <div class="card">
        <!-- <div class="card-body"> -->
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
                            <a href="#" class="btn btn-warning">edit</a>
                            <a href="#" class="btn btn-danger" onclick="return confirm('Yakin?');">delete</a>
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