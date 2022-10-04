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
                        <div>
                            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                            <a href="<?= base_url(); ?>index.php/keuangan/print/" target="blank" class="btn btn-primary"><i class="bi-printer-fill"></i> Print</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="mt-3" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">NO.</th>
                        <th class="text-center">ANGGOTA</th>
                        <th class="text-center">SIM</th>
                        <th class="text-center">KONSUMSI</th>
                        <th class="text-center">NON KONSUMS</th>
                        <th class="text-center">PINJ. KHUSUS</th>
                        <th class="text-center">PINJ. SP</th>
                        <th class="text-center">KE</th>
                        <th class="text-center">SIM. POKOK</th>
                        <th class="text-center">SIM. WAJIB</th>
                        <th class="text-center">TUNGGAKAN</th>
                        <th class="text-center">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($keuangan as $lap) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= $lap['NAMA_ANG']; ?></td>
                            <td></td>
                            <td></td>
                            <td><?= $lap['POKU3'] + $lap['BNGU3']; ?></td>
                            <td></td>
                            <td><?= $lap['POKU1'] + $lap['BNGU1']; ?></td>
                            <td><?= $lap['KEU1']; ?></td>
                            <td></td>
                            <!--MUNCUL KETIKA PERTAMA BERGABUNG-->
                            <td><?= $lap['WAJIB']; ?></td>
                            <td></td>
                            <?php
                            $potongan = $lap['WAJIB'] +
                                $lap['POKU1'] + $lap['BNGU1'] +
                                $lap['POKU2'] + $lap['BNGU2'] +
                                $lap['POKU3'] + $lap['BNGU3'] +
                                $lap['POKU4'] + $lap['BNGU4'] +
                                $lap['POKU5'] + $lap['BNGU5'] +
                                $lap['POKU6'] + $lap['BNGU6'] +
                                $lap['POKU7'] + $lap['BNGU7'] +
                                $lap['POKU8'] + $lap['BNGU8'];
                            ?>
                            <td><?= $potongan; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
$this->load->view('templates/footer');
?>