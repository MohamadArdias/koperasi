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
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">No. Rekening</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal Berhenti</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $anggota = $this->db->query("SELECT * FROM `anggota` INNER JOIN instan ON anggota.KODE_INS = instan.KODE_INS WHERE instan.KODE_INS = 96 OR instan.KODE_INS = 97 OR instan.KODE_INS = 98 OR instan.KODE_INS = 99 ORDER BY instan.KODE_INS ASC")->result_array();
                    foreach ($anggota as $ang) :
                        if ($ang['REKENING'] != NULL) {
                            $a = 'XXXXXX' . substr($ang['REKENING'], -4) . '';
                        } else {
                            $a = '';
                        }
                    ?>
                        <tr>
                            <td><?= $i; $i++;?></td>
                            <td><a href="<?= base_url(); ?>index.php/Anggota/histori2/<?= $ang['KODE_ANG']; ?>"><?= $ang['KODE_ANG'] . '/' . $ang['NAMA_ANG']; ?></a></td>
                            <td><?= $a; ?></td>
                            <td><?= $ang['KODE_INS']; ?>/ <?= $ang['NAMA_INS']; ?></td>
                            <td><?= $ang['TGLK_ANG']; ?></td>
                            <td><a href="<?= base_url(); ?>index.php/Anggota/detail/<?= $ang['KODE_ANG']; ?>" class="btn btn-warning">Detail</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>