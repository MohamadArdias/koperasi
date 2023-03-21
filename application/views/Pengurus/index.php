<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<!-- <style>
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
</style> -->
<div class="card">
    <div class="card-body">
        <table>
                <tr>
                    <th>Ketua</th>
                    <td width="20"></td>
                    <td>: <?= $pengurus['KETUA']; ?></td>
                </tr>
                <tr>
                    <th>Wakil</th>
                    <td width="20"></td>
                    <td>: <?= $pengurus['WAKIL']; ?></td>
                </tr>
                <tr>
                    <th>Bendahara 1</th>
                    <td width="20"></td>
                    <td>: <?= $pengurus['BENDAH1']; ?></td>
                </tr>
                <tr>
                    <th>Bendahara 2</th>
                    <td width="20"></td>
                    <td>: <?= $pengurus['BENDAH2']; ?></td>
                </tr>
                <tr>
                    <th>Rekening</th>
                    <td width="20"></td>
                    <td>: <?= $pengurus['REKENING']; ?></td>
                </tr>
                <tr>
                    <td><a href="<?= base_url(); ?>index.php/pengurus/edit/<?= $pengurus['ID']; ?>" class="btn btn-warning">Edit</a></td>
                </tr>
        </table>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>