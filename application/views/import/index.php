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
<div class="container">
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col">
                                <form action="<?= base_url(); ?>index.php/import" enctype="multipart/form-data" method="post">
                                    <input type="file" name="upload_excel" required>
                                    <input type="submit" name="submit" value="submit" class="btn btn-primary">
                                    <?php if ($this->session->flashdata('succes')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><?= $this->session->flashdata('succes') ?></strong>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('error')) { ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><?= $this->session->flashdata('error') ?></strong>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                            <div class="col text-end">
                                <form action="<?= base_url(); ?>index.php/import/potong" method="post">
                                    <button type="submit" class="btn btn-warning">Potong</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-borderless datatable" id="customers">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">TANGGGAL</th>
                            <th scope="col">NOMOR REKENING</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">NOMINAL</th>
                            <th scope="col">KOPERASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($temp as $bayar) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $bayar['TANGGAL']; ?></td>
                                <td><?= $bayar['NO_REKENING']; ?></td>
                                <td><?= $bayar['NAMA']; ?></td>
                                <td><?= $bayar['NOMINAL']; ?></td>
                                <td><?= $bayar['KOP']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>