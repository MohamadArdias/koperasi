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
            <form action="<?= base_url(); ?>index.php/pinsim/cetakPinsim">
                <div class="input-group">
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
                        <?php
                        if ($this->input->get('TAHUN') == '') {
                            $TAH = date('Y');
                        } else {
                            $TAH = $this->input->get('TAHUN');
                        }

                        $query = $this->db->query("SELECT DISTINCT pl.TAHUN, pl.BULAN FROM pl INNER JOIN pinsimp ON pl.TAHUN = pinsimp.TAHUN AND pl.BULAN = pinsimp.BULAN AND pl.KODE_ANG = pinsimp.KODE_ANG ORDER BY pl.TAHUN DESC, pl.BULAN DESC")->result_array();
                        foreach ($query as $key) {
                        ?>
                            <option value="<?= $key['TAHUN'] . '-' . $key['BULAN']; ?>"><?= $key['TAHUN'] . '-' . $key['BULAN']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                </div>
            </form>

            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Pokok</th>
                        <th class="text-center">Wajib Awal Tahun</th>
                        <th class="text-center">Wajib <?= $TAH; ?></th>
                        <th class="text-center">Total Wajib</th>
                        <th class="text-center">Rela Awal</th>
                        <th class="text-center">Rela</th>
                        <th class="text-center">Total Rela</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keuangan as $lap) :
                        $relNow = round(($lap['TOTREL'] + $lap['TOTWJB']) * 0.00371);
                    ?>
                        <tr>
                            <td><?= $lap['TAHUN'] . '-' . $lap['BULAN'] ?></td>
                            <td><?= $lap['KODE_ANG'] . '/' . $lap['NAMA_ANG']; ?></td>
                            <td><?= $lap['KODE_INS'] . '/' . $lap['NAMA_INS']; ?></td>
                            <td><?= $lap['TOTPOK'] ?></td>
                            <td style="padding-left: 20px; padding-right: 20px;" class="text-right"><?= number_format($lap['TOTWJB'], 0, ',', '.')  ?></td>
                            <td class="text-right"><?= number_format($lap['TWAJIB'] - $lap['TOTWJB'], 0, ',', '.')  ?></td>
                            <td class="text-right"><?= number_format($lap['TWAJIB'], 0, ',', '.')  ?></td>
                            <td style="padding-left: 20px; padding-right: 20px;"><?= $lap['TOTREL'] ?></td>
                            <td style="padding-left: 20px; padding-right: 20px;"><?= $lap['KET'] ?></td>
                            <td style="padding-left: 20px; padding-right: 20px;"><?= $lap['TOTREL'] + $lap['KET'] ?></td>
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