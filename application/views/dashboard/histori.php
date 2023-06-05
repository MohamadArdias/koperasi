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
    padding: 12px;
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
        <form action="<?= base_url(); ?>index.php/anggota/histori/<?= $get['KODE_ANG']; ?>" method="post">
          <div class="input-group">
            <button class="btn btn-primary">Cetak Excel</button>
            <!-- <a href="<?= base_url(); ?>index.php/anggota/tambah" class="btn btn-primary">Tambah Anggota</a> -->
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-3 overflow-auto">
      <table class="table table-borderless datatable" id="customers">
        <thead>
          <tr>
            <th style="padding-left: 30px; padding-right: 30px;">Bulan</th>
            <th>Simpanan Wajib</th>
            <th>Ke</th>
            <th>Uang</th>
            <th>Ke</th>
            <th>Non Konsumsi</th>
            <th>Ke</th>
            <th>Khusus</th>
            <th>Ke</th>
            <th>Konsumsi</th>
            <th>Ke</th>
            <th>UUB</th>
            <th>Tagihan</th>
            <th>Tunggakan</th>
            <th>Total</th>
            <th>Terbayar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($anggota as $ang) :
            $uang = $ang['POKU1'] + $ang['BNGU1'];
            $kons = $ang['POKU2'] + $ang['BNGU2'];
            $non = $ang['POKU3'] + $ang['BNGU3'];
            $khus = $ang['POKU7'] + $ang['BNGU7'];
            $uub = $ang['POKU4'] + $ang['BNGU4']; 
            
            $tghn = $uang+$kons+$non+$khus+$uub+$ang['WAJIB']?>
            <tr>
              <td><?= $ang['TAHUN'] . '-' . $ang['BULAN']; ?></td>
              <td><?= number_format($ang['TWAJIB'], 0, ',', '.') ?></td>
              <td><?= $ang['KEU1']; ?></td>
              <td><?= number_format($uang, 0, ',', '.') ?></td>
              <td><?= $ang['KEU3']; ?></td>
              <td><?= number_format($non, 0, ',', '.') ?></td>
              <td><?= $ang['KEU7']; ?></td>
              <td><?= number_format($khus, 0, ',', '.') ?></td>
              <td><?= $ang['KEU2']; ?></td>
              <td><?= number_format($kons, 0, ',', '.') ?></td>
              <td><?= $ang['KEU4']; ?></td>
              <td><?= number_format($uub, 0, ',', '.') ?></td>
              <td><?= number_format($tghn, 0, ',', '.') ?></td>
              <td><?= number_format($ang['POKU6'], 0, ',', '.') ?></td>
              <td><?= number_format($tghn+$ang['POKU6'], 0, ',', '.') ?></td>
              <td><?= number_format($ang['JML_BAYAR']+$ang['BAYAR_BANK'], 0, ',', '.') ?></td>
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