<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<div class="card">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>No. Urut</th>
        <!-- <th>Limit Kredit</th>
        <th>Konsumsi</th>
        <th>Kode Instansi</th>
        <th>Instansi</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Golongan</th> -->
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($anggota as $ang) : ?>
        <tr>
          <td><?= $ang['KODE_ANG']; ?></td>
          <td><?= $ang['NAMA_ANG']; ?></td>
          <td><?= $ang['URUT_ANG']; ?></td>
          <td>
            <a href="<?= base_url(); ?>index.php/Anggota/detail/<?= $ang['URUT_ANG']; ?>" class="btn btn-success">Detail</a>
            <a href="#" class="btn btn-warning">Edit</a>
            <a href="#" class="btn btn-danger" onclick="return confirm('Yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

<p>To understand the example better, we have added borders to the table.</p>

</body>

<?php
$this->load->view('templates/footer');
?>