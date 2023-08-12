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
        <?php if ($this->session->flashdata('flash')) : ?>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Sukarela <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="overflow-auto">
            <form action="<?= base_url(); ?>index.php/EditTunggakan/edit/" method="POST">
                <div class="input-group">
                    <!-- <div class="col-md-3"> -->
                        <?php
                        $THN = $this->input->get('TAHUN');
                        $BLN = $this->input->get('BULAN');
                        ?>
                        
                    <!-- </div> -->
                    <button type="submit" name="generate" class="btn btn-primary mb-2">Simpan</button>
                </div>
                <table class="table table-borderless" id="customers">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Tunggakan</th>
                            <th class="text-center">Rubah Tunggakan</th>
                            <input type="hidden" id="TAHUN" name="TAHUN" value="<?= $THN; ?>">
                            <input type="hidden" id="BULAN" name="BULAN" value="<?= $BLN; ?>">
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($query as $key) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $key['KODE_ANG']; ?>/ <?= $key['NAMA_ANG']; ?></td>
                                <td><?= $key['KODE_INS']; ?>/ <?= $key['NAMA_INS']; ?></td>
                                <td><?= $key['POKU6']; ?></td>
                                <td>
                                    <input type="hidden" id="id<?= $key['KODE_ANG']; ?>" name="id<?= $key['KODE_ANG']; ?>" value="<?= $key['KODE_ANG']; ?>">
                                    <input type="number" id="name<?= $key['KODE_ANG']; ?>" name="name<?= $key['KODE_ANG']; ?>" value="<?= $key['POKU6']; ?>">
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </form>
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