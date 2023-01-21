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
                        <div class="col-md-3 text-end">
                            <form action="<?= base_url(); ?>index.php/import/potong" method="post">
                                <div class="input-group">
                                    <select id="GET_POTONG" name="GET_POTONG" class="form-select" aria-label="Default select example">
                                        <!-- <option hidden>--Pilih--</option> -->
                                        <?php
                                        $query = $this->db->query("SELECT DISTINCT
                                            pl.TAHUN, 
                                            pl.BULAN
                                        FROM
                                            pl
                                            INNER JOIN
                                            pinuang
                                            ON 
                                                pl.KODE_ANG = pinuang.KODE_ANG
                                        WHERE
                                            pl.TAHUN = pinuang.TAHUN AND
                                            pl.BULAN = pinuang.BULAN
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
                                    <button type="submit" name="generate" class="btn btn-warning">Potong</button>
                                    <!-- <a href="<?= base_url(); ?>index.php/genta/simpan" class="btn btn-primary">Generate</a> -->
                                </div>
                                <!-- <button type="submit" class="btn btn-warning">Potong</button> -->
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
                    <?php
                    // $temp = $this->db->get('temp')->result_array();

                    $i = 1;
                    foreach ($temp as $bayar) :
                        if ($bayar['NO_REKENING'] != NULL) {
                            $a = 'XXXXXX' . substr($bayar['NO_REKENING'], -4) . '';
                        } else {
                            $a = '';
                        } ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $bayar['TANGGAL']; ?></td>
                            <td><?= $a; ?></td>
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
<?php
$this->load->view('templates/footer');
?>