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
</style>

<div class="card">
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-md-12">
                <form action="<?= base_url(); ?>index.php/Transaksi" method="post">
                    <div class="input-group">
                        <div class="col-sm-7"></div>
                        <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                        <input type="submit" class="btn btn-primary" name="submit" value="Cari">
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-auto">
            <table class="mt-3" id="customers">
                <thead class="table-primary">
                    <tr>
                        <th width="" >No. Faktur</th>
                        <th width="" >Anggota</th>
                        <th width="" >Instansi</th>
                        <th width="" >Tanggal</th>
                        <th width="" >Jangka</th>
                        <th width="" >Ke</th>
                        <th width="" >%</th>
                        <th width="" >Plafon</th>
                        <th width="" >Sisa Awal</th>
                        <th width="" >Angsuran</th>
                        <th width="" >Bunga</th>
                        <th width="" >Ke</th>
                        <th width="" >Sisa Akhir</th>
                        <th width="" >JPOK Tahun Lalu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dt_transaksi as $lap) : ?>
                        <tr>
                            <td><?= $lap['NOFAK']; ?></td>                            
                            <td><?= $lap['KODE_ANG'],"/",$lap['NAMA_ANG']; ?></td>                            
                            <td><?= $lap['KODE_INS'],"/",$lap['NAMA_INS']; ?></td>                            
                            <td><?= $lap['TGLP_ANG']; ?></td>                            
                            <td><?= $lap['JWKT_ANG']; ?></td>                            
                            <td><?= $lap['KE_ANG']; ?></td>                            
                            <td><?= $lap['PRO_ANG']; ?></td>                            
                            <td><?= $lap['JMLP_ANG']; ?></td>
                            <td></td>                            
                            <td><?= $lap['POK_13']; ?></td>                            
                            <td><?= $lap['BNG_13']; ?></td>
                            <td></td>                            
                            <td></td>                            
                            <td></td>                            
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="mt-3">
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>


<?php
$this->load->view('templates/footer');
?>