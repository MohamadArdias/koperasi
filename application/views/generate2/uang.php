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
        padding-top: 10px;
        padding-bottom: 10px;
        /* text-align: center; */
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th>FAKTUR</th>
                        <th style=" padding-right: 3cm; padding-left: 3cm;">NAMA</th>
                        <th>INSTANSI</th>
                        <th>JUMLAH PINJAMAN</th>
                        <th>BUNGA (%)</th>
                        <th>KE (TAHUN)</th>
                        <th>JANGKA</th>
                        <th>PERIODE</th>
                        <th>POKOK</th>
                        <th>SISA POKOK</th>
                        <th>BUNGA (RP)</th>
                        <th>CICILAN</th>
                        <th style="padding-right: 1.5cm; padding-left: 1.5cm;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($uang as $key) :
                        $KEU1 = $key['KEU1'];
                        $JWKT_ANG = $key['JWKT_ANG'];

                        if ($KEU1 == $JWKT_ANG) {
                            $STATUS = 'LUNAS';
                            $JWKT_ANG = 0;
                        } else {
                            $STATUS = 'BELUM LUNAS';
                            $JWKT_ANG;
                        }

                        if ($STATUS == 'LUNAS') {
                            $JMLP_ANG = 0;
                            $PRO_ANG = 0;
                            $KE_ANG = 0;
                            $KEU1 = 0;
                            $POKU1 = 0;
                            $SIPOKU1 = 0;
                            $BNGU1 = 0;
                            $CICILAN = 0;
                        } else {
                            $JMLP_ANG = $key['JMLP_ANG'];
                            $PRO_ANG = $key['PRO_ANG'];
                            $KEU1 = $key['KEU1']+1;
                            
                            if (date('m') == 12) {
                                $KE_ANG = $KEU1;                                
                            } else {
                                $KE_ANG = $key['KE_ANG'];
                            }    

                            if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                                $POKU1 = 0;
                            } else {
                                $POKU1 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU1']                                
                            }
                            $SIPOKU1 = $JMLP_ANG-($POKU1*$KEU1); //$key['SIPOKU1']-$key['POKU1'] //$key['SIPOKU1']-$POKU1;
                            $BNGU1 = $JMLP_ANG*($PRO_ANG/100);
                            $CICILAN = $JMLP_ANG-$SIPOKU1;
                        }
                        
                        
                    ?>
                        <tr>
                            <td><?= $key['NOFAK']; ?></td>
                            <td><?= $key['NAMA_ANG']; ?></td>
                            <td><?= $key['NAMA_INS']; ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($JMLP_ANG, 0, ',', '.'); ?></td>
                            <td><?= $PRO_ANG; ?></td>
                            <td><?= $KE_ANG; ?></td>
                            <td><?= $JWKT_ANG; ?></td>
                            <td><?= $KEU1; ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($POKU1, 0, ',', '.'); ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($SIPOKU1, 0, ',', '.'); ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($BNGU1, 0, ',', '.'); ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($CICILAN, 0, ',', '.'); ?></td>
                            <td style="text-align: center;"><?= $STATUS; ?></td>
                            
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