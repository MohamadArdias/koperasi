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
            Data anggota <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="overflow-auto">
      <table class="table table-borderless datatable" id="customers">
        <thead class="table-primary">
          <tr>
            <th class="text-center">Kode Anggota</th>
            <th class="text-center">Nama Anggota</th>
            <th class="text-center">Instansi</th>
            <th class="text-center">Histori</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($anggota as $ang) : 
            if ($ang['REKENING'] != NULL) {
              $a = 'XXXXXX'.substr($ang['REKENING'],-4).'';
            } else {
              $a = '';
            }
            ?>
            <tr>
              <td class="text-center"><?= $ang['URUT_ANG']; ?></td>
              <td><?= $ang['NAMA_ANG']; ?></td>
              <td><?= $ang['KODE_INS']; ?>/ <?= $ang['NAMA_INS']; ?></td>
              <td class="text-center">
			  <a href="<?= base_url(); ?>index.php/Dashboard/histori/<?= $ang['URUT_ANG']; ?>" class="btn btn-success">Lihat</a>
              </td>
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