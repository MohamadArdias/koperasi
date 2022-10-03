<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered mt-3">
            <thead class="table-primary">
                <tr>
                    <th class="text-center">Kode Instansi</th>
                    <th class="text-center">Nama Instansi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instansi as $ins) : ?>
                    <tr>
                        <td><?= $ins['KODE_INS']; ?></td>
                        <td><?= $ins['NAMA_INS']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url(); ?>index.php/kirim/printins/<?= $ins['KODE_INS']; ?>" class="btn btn-success">Lihat</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>