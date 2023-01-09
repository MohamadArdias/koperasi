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
            <select id="pinsimp" onchange="pins()" class="form-select col-md-2" aria-label="Default select example">
                <option hidden>Date</option>
                <?php $query = $this->db->query("SELECT DISTINCT TAHUN, BULAN FROM pl")->result_array();
                foreach ($query as $key) {
                ?>
                    <option value="<?= $key['TAHUN'] . '-' . $key['BULAN']; ?>"><?= $key['TAHUN'] . '-' . $key['BULAN']; ?></option>
                <?php
                }
                ?>
            </select>
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Tabungan Awal Tahun</th>
                        <th class="text-center">Tabungan <?= date('Y'); ?></th>
                        <th class="text-center">Total Tabungan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keuangan as $lap) : ?>
                        <tr>
                            <td><?= $lap['TAHUN'] . '-' . $lap['BULAN'] ?></td>
                            <td><?= $lap['URUT_ANG'] . '/' . $lap['NAMA_ANG']; ?></td>
                            <td><?= $lap['KODE_INS'] . '/' . $lap['NAMA_INS']; ?></td>
                            <td class="text-right"><?= number_format($lap['TOTWJB'], 0, ',', '.')  ?></td>
                            <td class="text-right"><?= number_format($lap['TWAJIB'] - $lap['TOTWJB'], 0, ',', '.')  ?></td>
                            <td class="text-right"><?= number_format($lap['TWAJIB'], 0, ',', '.')  ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function pins() {
        var option = document.getElementById("pinsimp").value;
        console.log(option);
        window.location.assign("?TAHUN=" + option.substr(0, 4) + "&&BULAN=" + option.substr(-2));
    }
</script>

<?php
$this->load->view('templates/footer');
?>