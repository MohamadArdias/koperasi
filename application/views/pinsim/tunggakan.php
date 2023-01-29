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
                <?php
                $TAHUN = $this->input->get('TAHUN');
                $BULAN = $this->input->get('BULAN');

                if ($TAHUN == '' and $BULAN == '') {
                    $THN = date('Y');
                    $BLN = date('m');
                } else {
                    $THN = $TAHUN;
                    $BLN = $BULAN;
                }

                ?>

                <option hidden><?= $THN . '-' . $BLN; ?></option>
                <?php $query = $this->db->query("SELECT DISTINCT TAHUN, BULAN FROM pl ORDER BY pl.TAHUN DESC, pl.BULAN DESC")->result_array();
                foreach ($query as $key) {
                ?>
                    <option value="<?= $key['TAHUN'] . '-' . $key['BULAN']; ?>"><?= $key['TAHUN'] . '-' . $key['BULAN']; ?></option>
                <?php
                }
                ?>
            </select>
            <table class="table table-borderless datatable" id="customers">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Anggota</th>
                        <th scope="col">Instansi</th>
                        <th scope="col">Total Tunggakan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($tunggakan as $ang) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $ang['URUT_ANG'] . '/' . $ang['NAMA_ANG']; ?></td>
                            <td><?= $ang['KODE_INS'] . '/' . $ang['NAMA_INS']; ?></td>
                            <td style="text-align: right"><?= number_format($ang['POKU6'], 0, ',', '.') ?></td>
                            <td><span class="badge bg-danger">Belum Lunas</span></td>
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