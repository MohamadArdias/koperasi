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
    <?php if ($this->session->flashdata('pinjamGen')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('pinjamGen') ?></strong> melakukan generate
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group">
                    <a href="<?= base_url(); ?>index.php/genta/pinjaman" class="btn btn-primary">Generate</a>
                </div>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th>TAHUN</th>
                        <th>BULAN</th>
                        <th>FAKTUR</th>
                        <th style=" padding-right: 3cm; padding-left: 3cm;">ANGGOTA</th>
                        <th style=" padding-right: 3cm; padding-left: 3cm;">INSTANSI</th>
                        <th>JENIS PINJAMAN</th>
                        <th>JUMLAH PINJAMAN</th>
                        <th>JANGKA</th>
                        <th>PERIODE</th>
                        <th>POKOK</th>
                        <th>BUNGA (RP)</th>
                        <th>TOTAL</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pinjaman as $key) :
                        // jenis pinjaman
                        if (strpos($key['NOFAK'], 'U') !== false) {
                            $jenis = 'Uang';
                            $keu = $key['KEU1'];
                            $pokok = $key['POKU1'];
                            $bunga = $key['BNGU1'];
                        } elseif (strpos($key['NOFAK'], 'N') !== false) {
                            $jenis = 'Non Konsumsi';
                            $keu = $key['KEU3'];
                            $pokok = $key['POKU3'];
                            $bunga = $key['BNGU3'];
                        } elseif (strpos($key['NOFAK'], 'O') !== false) {
                            $jenis = 'Konsumsi';
                            $keu = $key['KEU2'];
                            $pokok = $key['POKU2'];
                            $bunga = $key['BNGU2'];
                        } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                            $jenis = 'Pinjaman Khusus';
                            $keu = $key['KEU7'];
                            $pokok = $key['POKU7'];
                            $bunga = $key['BNGU7'];
                        } elseif (strpos($key['NOFAK'], 'S') !== false) {
                            $jenis = 'Uang Untuk Barang';
                            $keu = $key['KEU4']; 
                            $pokok = $key['POKU4']; 
                            $bunga = $key['BNGU4']; 
                        }   
                        $total = $pokok+$bunga;                                                                   
                    ?>
                        <tr>
                            <td><?= $key['TAHUN']; ?></td>
                            <td><?= $key['BULAN']; ?></td>
                            <td><?= $key['NOFAK']; ?></td>
                            <td><?= $key['KODE_ANG'].'/ '.$key['NAMA_ANG']; ?></td>
                            <td><?= $key['KODE_INS'].'/ '.$key['NAMA_INS']; ?></td>
                            <td><?= $jenis; ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($key['JMLP_ANG'], 0, ',', '.'); ?></td>
                            <td><?= $key['JWKT_ANG']; ?></td>
                            <td><?= $keu; ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($pokok, 0, ',', '.'); ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($bunga, 0, ',', '.'); ?></td>
                            <td style="text-align: right; padding-right: 25px; padding-left: 25px;"><?= number_format($total, 0, ',', '.'); ?></td>                           
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