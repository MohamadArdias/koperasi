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
    <?php if ($this->session->flashdata('lunasB')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pelunasan <strong><?= $this->session->flashdata('lunasB'); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('lunasG')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Pelunasan <strong><?= $this->session->flashdata('lunasG'); ?></strong>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
                <?php $query = $this->db->query("SELECT DISTINCT
                    pl.TAHUN, 
                    pl.BULAN
                FROM
                    pl
                    INNER JOIN
                    pinuang
                    ON 
                        pl.TAHUN = pinuang.TAHUN AND
                        pl.BULAN = pinuang.BULAN AND
                        pl.KODE_ANG = pinuang.KODE_ANG
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
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th style="padding-left: 20px; padding-right: 20px;" class="text-center">Tanggal</th>
                        <th style="padding-left: 20px; padding-right: 20px;" class="text-center">Faktur</th>
                        <th style="padding-left: 60px; padding-right: 60px;" class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Jenis Pinjaman</th>
                        <th class="text-center">Jumlah Pinjaman</th>
                        <th class="text-center">Jangka</th>
                        <th class="text-center">Bunga(%)</th>
                        <th class="text-center">Periode</th>
                        <th class="text-center">Pokok</th>
                        <th class="text-center">Bunga(Rp)</th>
                        <th class="text-center">Sisa Pinjaman</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pinjaman as $key) {

                        // jenis pinjaman
                        if (strpos($key['NOFAK'], 'U') !== false) {
                            $jenis = 'Uang';                        
                            $angka = 1;
                        } elseif (strpos($key['NOFAK'], 'N') !== false) {
                            $jenis = 'Non Konsumsi';                        
                            $angka = 3;
                        } elseif (strpos($key['NOFAK'], 'O') !== false) {
                            $jenis = 'Konsumsi';                        
                            $angka = 2;
                        } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                            $jenis = 'Pinjaman Khusus';                        
                            $angka = 7;
                        } elseif (strpos($key['NOFAK'], 'S') !== false) {
                            $jenis = 'UUB';                        
                            $angka = 4;
                        }

                        if ($key['SIPOKU'.$angka] == 0) {
                            $status = 'LUNAS';
                        } else {
                            $status = 'BELUM LUNAS';
                        }
                    ?>
                        <tr>
                            <td><?= $key['TGLP_ANG'] ?></td>
                            <td><a href="<?= base_url(); ?>index.php/pelunasan?NOFAK=<?= $key['NOFAK']; ?>&&KODE=<?= $key['URUT_ANG'] ?>"><?= $key['NOFAK']; ?></a></td>
                            <td><?= $key['URUT_ANG'] . '/' . $key['NAMA_ANG']; ?></td>
                            <td><?= $key['KODE_INS'] . '/' . $key['NAMA_INS']; ?></td>
                            <td><?= $jenis; ?></td>
                            <td class="text-right"><?= number_format($key['JMLP_ANG'], 0, ',', '.'); ?></td>
                            <td class="text-right"><?= $key['JWKT_ANG'] ?></td>
                            <td><?= $key['PRO_ANG'] ?></td>
                            <td><?= $key['KEU'.$angka] ?></td>
                            <td><?= $key['POKU'.$angka] ?></td>
                            <td><?= $key['BNGU'.$angka] ?></td>
                            <td class="text-right"><?= number_format($key['SIPOKU'.$angka], 0, ',', '.'); ?></td>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php
                    } ?>
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