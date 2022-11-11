<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        /* font-weight: bold; */
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
                        <th class="text-center">No</th>
                        <th class="text-center">Faktur</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Jenis Pinjaman</th>
                        <th class="text-center">Jumlah Pinjaman</th>
                        <th class="text-center">Sisa Pinjaman</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($pinjaman as $key) {

                        // jenis pinjaman
                        if (strpos($key['NOFAK'], 'U') !== false) {
                            $jenis = 'Uang';
                            $sisa = $key['SIPOKU1'];
                        } elseif (strpos($key['NOFAK'], 'N') !== false) {
                            $jenis = 'Non Konsumsi';
                            $sisa = $key['SIPOKU3'];
                        } elseif (strpos($key['NOFAK'], 'O') !== false) {
                            $jenis = 'Konsumsi';
                            $sisa = $key['SIPOKU2'];
                        } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                            $jenis = 'Pinjaman Khusus';
                            $sisa = $key['SIPOKU7'];
                        } elseif (strpos($key['NOFAK'], 'S') !== false) {
                            $jenis = 'SIM';
                            $sisa = $key['SIPOKU1']; //belum teridentifikasi
                        }             
                        
                        if ($sisa == 0) {
                            $status = 'LUNAS';
                        } else {
                            $status = 'BELUM LUNAS';
                        }
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $key['NOFAK']; ?></td>
                            <td><?= $key['NAMA_ANG']; ?></td>
                            <td><?= $key['NAMA_INS']; ?></td>
                            <td><?= $jenis; ?></td>
                            <td class="text-right"><?= number_format($key['JMLP_ANG'], 0, ',', '.'); ?></td>
                            <td class="text-right"><?= number_format($sisa, 0, ',', '.'); ?></td>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>