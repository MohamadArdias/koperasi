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

    <div class="row mt-3">
      <div class="col-md-12">
        <form action="" method="post">
          <div class="input-group">
            <div>
              <a href="<?= base_url(); ?>index.php/Anggota/tambah" class="btn btn-primary">Tambah Anggota</a>
            </div>
            <div class="col"></div>
            <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
            <!-- <div class="input-group-append"> -->
            <button class="btn btn-primary" type="submit">Cari</button>
            <!-- </div>b -->
          </div>
        </form>
      </div>
    </div>

    <div class="overflow-auto">
      <table class="mt-3" id="customers">
        <thead class="table-primary">
          <tr>
            <th class="text-center">No. Urut</th>
            <th class="text-center">Nama Anggota</th>
            <th class="text-center">Status / Instansi</th>
            <th class="text-center">Golongan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($anggota as $ang) : ?>
            <tr>
              <td class="text-center"><?= $ang['URUT_ANG']; ?></td>
              <td><?= $ang['NAMA_ANG']; ?></td>
              <td><?= $ang['NAMA_INS']; ?></td>
              <td><?= $ang['GOL']; ?></td>
              <td class="text-center">
                <a href="<?= base_url(); ?>index.php/Anggota/detail/<?= $ang['URUT_ANG']; ?>" class="btn btn-info">Detail</a>
                <a href="<?= base_url(); ?>index.php/Anggota/edit/<?= $ang['URUT_ANG']; ?>" class="btn btn-warning">Edit</a>
                <a href="<?= base_url(); ?>index.php/Anggota/hapus/<?= $ang['URUT_ANG']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?');">Hapus</a>
              </td>
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