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

<div class="col-xxl-4 col-xl-7">
    <div class="card">
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-12">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control col-sm-6" placeholder="Pencarian" name="keyword">
                            <button class="btn btn-primary" type="submit">Cari</button>
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keuangan as $ins) : ?>
                            <tr>
                                <td><?= $ins['KODE_INS']; ?></td>
                                <td><?= $ins['NAMA_INS']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url(); ?>index.php/keuangan/printins/<?= $ins['KODE_INS']; ?>" class="btn btn-secondary">Lihat</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>