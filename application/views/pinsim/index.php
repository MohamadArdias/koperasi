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
        <div class="row mt-3">
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="input-group">
                        <div class="col-sm-7"></div>
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="mt-3" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Tabungan</th>
                        <th class="text-center">Hutang</th>
                        <th class="text-center">Tunggakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keuangan as $lap) : ?>
                        <tr>
                            <td class="text-center"><?= $lap['KODE_ANG']; ?></td>
                            <td><?= $lap['NAMA_ANG']; ?></td>
                            <td><?= $lap['NAMA_INS']; ?></td>
                            <td><?= $lap['TWAJIB']; ?></td>
                            <?php
                            $hutang =
                                $lap['SIPOKU1'] +
                                $lap['SIPOKU2'] +
                                $lap['SIPOKU3'] +
                                $lap['SIPOKU4'] +
                                $lap['SIPOKU5'] +
                                $lap['SIPOKU6'] +
                                $lap['SIPOKU7'] +
                                $lap['SIPOKU8'];
                            ?>
                            <td><?= $hutang; ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>

        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>