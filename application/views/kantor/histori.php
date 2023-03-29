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
        <form action="<?= base_url(); ?>index.php/kantor/histori/<?= $get['KODE_ANG']; ?>" method="post">
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
            <th>Ke</th>
            <th>Sisa Pokok</th>
            <th>Sisa Bunga</th>
            <th>Total</th>
            <th>Bayar Pokok</th>
            <th>Bayar Bunga</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($anggota as $ang) :            
          ?>
            <tr>
              <td><?= $ang['TAHUN'] . '-' . $ang['BULAN']; ?></td>
              <td><?= $ang['KEU8']; ?></td>
              <td><?= $ang['SIPOKU8']; ?></td>
              <td><?= $ang['SIBNGU8']; ?></td>
              <td><?= $ang['SIPOKU8']+$ang['SIBNGU8']; ?></td>
              <td><?= $ang['POKU8']; ?></td>
              <td><?= $ang['BNGU8']; ?></td>
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