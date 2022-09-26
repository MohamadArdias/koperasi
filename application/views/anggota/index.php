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

  <table class="table">
    <thead>
      <tr>
        <th>No. Urut</th>
        <th>Nama</th>
        <th>Status / Instansi</th>
        <th>Golongan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($anggota as $ang) : ?>
        <tr>
          <td><?= $ang['URUT_ANG']; ?></td>
          <td><?= $ang['NAMA_ANG']; ?></td>
          <td><?= $ang['NAMA_INS']; ?></td>
          <td><?= $ang['GOL']; ?></td>
          <td>
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

<p>To understand the example better, we have added borders to the table.</p>

</body>

<?php
$this->load->view('templates/footer');
?>