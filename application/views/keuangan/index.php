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
            <div class="col-md-3">
                <form action="<?= base_url(); ?>index.php/keuangan/export" method="post">
                    <div class="input-group">
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
                        <input type="hidden" name="TAHUN" class="form-control" id="TAHUN" value="<?= $THN ?>" />
                        <input type="hidden" name="BULAN" class="form-control" id="BULAN" value="<?= $BLN; ?>" />

                        <select id="GETEX" name="GETEX" onchange="getEx()" class="form-select" aria-label="Default select example">
                            <option hidden><?= $THN . '-' . $BLN; ?></option>
                            <?php
                            $query = $this->db->query("SELECT DISTINCT
                                pl.TAHUN, 
                                pl.BULAN
                            FROM
                                pl
                                INNER JOIN
                                pembayaran
                                ON 
                                    pl.KODE_ANG = pembayaran.KODE_ANG AND
                                    pl.TAHUN = pembayaran.TAHUN AND
                                    pl.BULAN = pembayaran.BULAN
                            WHERE
                                pl.TAHUN = pembayaran.TAHUN AND
                                pl.BULAN = pembayaran.BULAN
                            ORDER BY
                                pl.TAHUN DESC, 
                                pl.BULAN DESC")->result_array();

                            foreach ($query as $key) {
                            ?>
                                <option value="<?= $key['TAHUN'] . '-' . $key['BULAN']; ?>"><?= $key['TAHUN'] . '-' . $key['BULAN']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" name="generate" class="btn btn-primary">Export</button>
                        <!-- <a href="<?= base_url(); ?>index.php/genta/simpan" class="btn btn-primary">Generate</a> -->
                    </div>

                </form>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Tagihan</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Potongan</th>
                        <th class="text-center">Koperasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($keuangan as $lap) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $lap['TGL_TGHN']; ?></td>
                            <td><?= $lap['KODE_ANG'] . '/' . $lap['NAMA_ANG']; ?></td>
                            <td><?= $lap['NAMA_INS']; ?></td>
                            <td class="text-right"><?= number_format($lap['JML_TGHN'], 0, ',', '.'); ?></td>
                            <td><?= 'KPRI "BANGKIT BERSAMA"'; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function getEx() {
        var option = document.getElementById("GETEX").value;
        console.log(option);
        window.location.assign("?TAHUN=" + option.substr(0, 4) + "&&BULAN=" + option.substr(-2));
    }
</script>


<?php
$this->load->view('templates/footer');
?>