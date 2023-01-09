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
<div class="row mt-3">
  <table class="table table-borderless datatable" id="customers">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Uang</th>
					<th scope="col">Ke</th>
                    <th scope="col">Konsumsi</th>
					<th scope="col">Ke</th>
                    <th scope="col">Khusus</th>
					<th scope="col">Ke</th>
                    <th scope="col">Konsumsi</th>
					<th scope="col">Ke</th>
                    <th scope="col">UUB</th>
					<th scope="col">Ke</th>
					<th scope="col">Tanggal Tagihan</th>
                    <th scope="col">Tanggal Bayar</th>
                    <th scope="col">Total Tagihan</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Via Bayar</th>
                    <th scope="col">Sisa Tunggakan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                  foreach ($anggota as $ang) : ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= $ang['KODE_ANG'].'/'.$ang['NAMA_ANG']; ?></td>
                      <td><?= $ang['NAMA_INS']; ?></td>
                      <td><?= $ang['TAHUN']; ?></td>
                      <td><?= $ang['BULAN']; ?></td>
                      <td><?= $ang['POKU1']; ?></td>
					  <td><?= $ang['KEU1']; ?></td>
                      <td><?= $ang['POKU3']; ?></td>
					  <td><?= $ang['KEU3']; ?></td>
                      <td><?= $ang['POKU7']; ?></td>
					  <td><?= $ang['KEU7']; ?></td>
                      <td><?= $ang['POKU2']; ?></td>
					  <td><?= $ang['KEU2']; ?></td>
                      <td><?= $ang['POKU4']; ?></td>
					  <td><?= $ang['KEU4']; ?></td>
					  <td><?= $ang['TGL_TGHN']; ?></td>
                      <td><?= $ang['TGL_BAYAR']; ?></td>
                      <td><?= $ang['JML_TGHN']; ?></td>
                      <td><?= $ang['JML_BAYAR']; ?></td>
                      <td><?= $ang['VIA_BAYAR']; ?></td>
                      <td><?= $ang['TUNGGAKAN']; ?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
</div>
<?php
$this->load->view('templates/footer');
?>