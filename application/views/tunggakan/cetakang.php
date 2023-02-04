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

<div class="col-xxl-4 col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="input-group">
                <div class="col-md-4">
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
                        <!-- <button type="submit" name="generate" class="btn btn-primary">Cetak Semua</button> -->
                        <a href="<?= base_url(); ?>index.php/tunggakan/cetakAll?TAHUN=<?= $THN ?>&&BULAN=<?= $BLN ?>" class="btn btn-primary" target="blank">Cetak Semua</a>
                    </div>
                </div>
            </div>
            <div class="overflow-auto">
                <table class="table table-borderless datatable" id="customers">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Tunggakan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($keuangan as $ins) :
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $ins['URUT_ANG'] . '/' . $ins['NAMA_ANG']; ?></td>
                                <td><?= $ins['KODE_INS'] . '/ ' . $ins['NAMA_INS']; ?></td>
                                <td class="text-right"><?= number_format($ins['POKU6'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url(); ?>index.php/tunggakan/printang/<?= $ins['URUT_ANG']; ?>?TAHUN=<?= $ins['TAHUN']; ?>&&BULAN=<?= $ins['BULAN']; ?>" class="btn btn-secondary" target="blank">Print</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
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