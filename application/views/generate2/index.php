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
        text-align: center;
        background-color: #0066ff;
        color: white;
    }

    #customers td {
        padding-top: 12px;
        padding-bottom: 12px;
        /* text-align: center; */
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>TOTAL WAJIB</th>
                        <th>TOTAL POKOK</th>
                        <th>TOTAL REL</th>
                        <th>WAJIB</th>
                        <th>POKOK</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($simpan as $key) :
                        $TAHUN = $key['TAHUN'];
                        $BULAN = $key['BULAN'];
                        $KODE_ANG = $key['KODE_ANG'];
                        $NAMA_ANG = $key['NAMA_ANG'];

                        if ($key['BULAN'] == 12) {
                            $TOTWJB = $key['TWAJIB'];
                            $TOTPOK = $key['TPOKOK'];
                        } else {
                            $TOTWJB = $key['TOTWJB'];
                            $TOTPOK = $key['TOTPOK'];
                        }

                        $TWAJIB = $key['TWAJIB'] + 100000;
                        $TPOKOK = 50000;
                    ?>
                        <tr>
                            <td style="text-align: center; "><?= $KODE_ANG; ?></td>
                            <td style="text-align: left; padding-left: 25px;"><?= $NAMA_ANG; ?></td>
                            <td style="text-align: right; padding-right: 25px;"><?= number_format($TOTWJB, 0, ',', '.') ; ?></td>
                            <td style="text-align: right; padding-right: 25px;"><?= number_format($TOTPOK, 0, ',', '.') ; ?></td>
                            <td style="text-align: right; padding-right: 25px;"></td>
                            <td style="text-align: right; padding-right: 25px;"><?= number_format($TWAJIB, 0, ',', '.') ; ?></td>
                            <td style="text-align: right; padding-right: 25px;"><?= number_format($TPOKOK, 0, ',', '.') ; ?></td>
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