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
        <?php if ($this->session->flashdata('pembayaranGen')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $this->session->flashdata('pembayaranGen') ?></strong> melakukan generate
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <form action="<?= base_url(); ?>index.php/genta/pembayaran">
                    <div class="input-group">
                        <select id="GEN_SIMP" name="GEN_SIMP" class="form-select" aria-label="Default select example">
                            <option hidden>--Pilih--</option>
                            <?php
                            $query = $this->db->query("SELECT DISTINCT
                                TAHUN, 
                                BULAN
                            FROM
                                pembayaran
                            ORDER BY
                                pembayaran.TAHUN DESC, 
                                pembayaran.BULAN DESC")->result_array();

                            foreach ($query as $key) {
                            ?>
                                <option value="<?= $key['TAHUN'] . '-' . $key['BULAN']; ?>"><?= $key['TAHUN'] . '-' . $key['BULAN']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <button type="submit" name="generate" class="btn btn-primary">Generate</button>
                        <!-- <a href="<?= base_url(); ?>index.php/genta/simpan" class="btn btn-primary">Generate</a> -->
                    </div>
                </form>
            </div>
        </div>
        <!-- <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group">
                    <a href="<?= base_url(); ?>index.php/genta/pembayaran" class="btn btn-primary">Generate</a>
                </div>
            </div>
        </div> -->
        <div class="overflow-auto">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal Tagihan</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Instansi</th>
                        <th class="text-center">Potongan</th>
                        <th class="text-center">Nama Koperasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($tagihan as $lap) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td class="text-center"><?= $lap['TGL_TGHN']; ?></td>
                            <td><?= $lap['KODE_ANG'] . '/' . $lap['NAMA_ANG']; ?></td>
                            <td><?= $lap['KODE_INS'] . '/ ' . $lap['NAMA_INS']; ?></td>
                            <td class="text-right"><?= number_format($lap['JML_TGHN'], 0, ',', '.'); ?></td>
                            <td><?= 'KPRI "BANGKIT BERSAMA"'; ?></td>
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