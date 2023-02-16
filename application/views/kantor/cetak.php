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

<div class="col-xxl-4 col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="overflow-auto">
                <table class="table table-borderless datatable" id="customers">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Tanggal Bayar</th>
                            <th class="text-center">Anggota</th>
                            <th class="text-center">Instansi</th>
                            <th class="text-center">Tagihan</th>
                            <th class="text-center">Bayar</th>
                            <th class="text-center">VIA Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key) : ?>
                            <tr>
                                <td><?= $key['TGL_BAYAR']; ?></td>
                                <td><?= $key['URUT_ANG'] . '/' . $key['NAMA_ANG']; ?></td>
                                <td><?= $key['KODE_INS'] . '/ ' . $key['NAMA_INS']; ?></td>
                                <td><?= $key['JML_TGHN']; ?></td>
                                <td><?= $key['JML_BAYAR']; ?></td>
                                <td><?= $key['CREATED_BY'].'-'.$key['VIA_BAYAR']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url(); ?>index.php/kantor/print/<?= $key['URUT_ANG']; ?>?time=<?= $key['CREATED']; ?>" class="btn btn-secondary" target="blank">Print</a>
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
</script>

<?php
$this->load->view('templates/footer');
?>