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

<div class="col-xxl-7 col-xl-10">
    <div class="card">
        <div class="card-body">
            <div class="input-group">
                <div class="col-md-3">
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
                </div>
            </div>
            <div class="overflow-auto">
                <table class="table table-borderless datatable" id="customers">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keuangan as $ins) : ?>
                            <tr>
                                <td><?= $ins['TAHUN']; ?></td>
                                <td><?= $ins['BULAN']; ?></td>
                                <td><?= $ins['KODE_INS'] . '/ ' . $ins['NAMA_INS']; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-success" style="color:white;" onclick="getLocation('<?= $ins['KODE_INS']; ?>')">Print Instansi</a>
                                    <a href="<?= base_url(); ?>index.php/keuangan/printinsang/<?= $ins['KODE_INS']; ?>?TAHUN=<?= $ins['TAHUN']; ?>&&BULAN=<?= $ins['BULAN']; ?>" class="btn btn-primary" target="blank">Print Aggota</a>
                                    <a href="<?= base_url(); ?>index.php/EditTunggakan/editIns/<?= $ins['KODE_INS']; ?>?TAHUN=<?= $ins['TAHUN']; ?>&&BULAN=<?= $ins['BULAN']; ?>" class="btn btn-warning" target="blank">Edit Tunggakan</a>
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

    function getLocation(value) {
        var link1 = "<?= base_url(); ?>index.php/keuangan/printins/"+value+"?TAHUN=<?= $ins['TAHUN']; ?>&&BULAN=<?= $ins['BULAN']; ?>&&NAMA=NAMA_ANG";
        var link2 = "<?= base_url(); ?>index.php/keuangan/printins/"+value+"?TAHUN=<?= $ins['TAHUN']; ?>&&BULAN=<?= $ins['BULAN']; ?>&&NAMA=KODE_ANG";
        var choice = confirm("Cetak Berdasarkan Nama?");

        if (choice == true) {
            window.open(link1, "_blank");
        } else {
            window.open(link2, "_blank");
        }
    }
</script>

<?php
$this->load->view('templates/footer');
?>