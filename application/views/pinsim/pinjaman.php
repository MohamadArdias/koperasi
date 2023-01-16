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
                <option hidden>Date</option>
                <?php $query = $this->db->query("SELECT DISTINCT TAHUN, BULAN FROM pl ORDER BY pl.TAHUN DESC, pl.BULAN DESC")->result_array();
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
                        <th style="padding-left: 20px; padding-right: 20px;" class="text-center">Bulan</th>
                        <th style="padding-left: 20px; padding-right: 20px;" class="text-center">Faktur</th>
                        <th style="padding-left: 60px; padding-right: 60px;" class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Jenis Pinjaman</th>
                        <th class="text-center">Jumlah Pinjaman</th>
                        <th class="text-center">Ke</th>
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
                            $sisa = $key['SIPOKU1'];
                            $ke = $key['KEU1'];
                        } elseif (strpos($key['NOFAK'], 'N') !== false) {
                            $jenis = 'Non Konsumsi';
                            $sisa = $key['SIPOKU3'];
                            $ke = $key['KEU3'];
                        } elseif (strpos($key['NOFAK'], 'O') !== false) {
                            $jenis = 'Konsumsi';
                            $sisa = $key['SIPOKU2'];
                            $ke = $key['KEU2'];
                        } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                            $jenis = 'Pinjaman Khusus';
                            $sisa = $key['SIPOKU7'];
                            $ke = $key['KEU7'];
                        } elseif (strpos($key['NOFAK'], 'S') !== false) {
                            $jenis = 'UUB';
                            $sisa = $key['SIPOKU4']; //belum teridentifikasi
                            $ke = $key['KEU4'];
                        }

                        if ($sisa == 0) {
                            $status = 'LUNAS';
                        } else {
                            $status = 'BELUM LUNAS';
                        }
                    ?>
                        <tr>
                            <td><?= $key['TAHUN'] . '-' . $key['BULAN'] ?></td>
                            <td><a href="<?= base_url(); ?>index.php/pelunasan?NOFAK=<?= $key['NOFAK']; ?>&&KODE=<?= $key['URUT_ANG'] ?>"><?= $key['NOFAK']; ?></a></td>
                            <td><?= $key['URUT_ANG'] . '/' . $key['NAMA_ANG']; ?></td>
                            <td><?= $key['KODE_INS'] . '/' . $key['NAMA_INS']; ?></td>
                            <td><?= $jenis; ?></td>
                            <td class="text-right"><?= number_format($key['JMLP_ANG'], 0, ',', '.'); ?></td>
                            <td><?= $ke ?></td>
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