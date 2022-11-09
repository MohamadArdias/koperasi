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
    <div class="col-12">

        <div class="card-body">
            <table class="table table-borderless datatable" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tool</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Pengurus as $ang) : ?>
                        <tr>
                            <td><?= $ang['JABATAN']; ?></td>
                            <td><?= $ang['NAMA']; ?></td>
                            <td><a href="<?= base_url(); ?>index.php/Pengurus/edit/<?= $ang['JABATAN']; ?>" class="btn btn-warning">Edit</a></td>
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