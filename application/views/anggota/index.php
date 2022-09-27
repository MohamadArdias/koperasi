<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
  <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
      <div class="col-md-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Data anggota <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="mt-3">
    <a href="<?= base_url(); ?>index.php/Anggota/tambah" class="btn btn-primary">Tambah Anggota</a>
  </div>
  <br>
  <table class="table">
    <thead>
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
          <td class="text-center"><?= $ang['NAMA_ANG']; ?></td>
          <td class="text-center"><?= $ang['NAMA_INS']; ?></td>
          <td class="text-center"><?= $ang['GOL']; ?></td>
          <td class="text-center">
            <a href="<?= base_url(); ?>index.php/Anggota/detail/<?= $ang['URUT_ANG']; ?>" class="btn btn-primary">Detail</a>
            <a href="<?= base_url(); ?>index.php/Anggota/edit/<?= $ang['URUT_ANG']; ?>" class="btn btn-warning">Edit</a>
            <a href="<?= base_url(); ?>index.php/Anggota/hapus/<?= $ang['URUT_ANG']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <?= $this->pagination->create_links(); ?>
</div>

</body>

<?php
$this->load->view('templates/footer');
?>