<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">

    </div>
    <div class="card-body">
      <form action="" method="POST">
        <center>
          <img src="https://radarbanyuwangi.jawapos.com/wp-content/uploads/2022/06/Logo-Koperasi-1.jpg" width="200" height="200" class="img-fluid rounded-start" alt="...">
          <h5 class="card-title"> Selamat Datang di Website <br> Koperasi Bangkit Bersama</h5>
        </center>

        <!-- Anggota aktif Card -->
        <div class="row">
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Anggota <span>| Aktif</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $aktif ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Anggota Aktif Card -->

          <!-- Tidak Aktif Card -->

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Anggota <span>| Tidak Aktif</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $tidak ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Tidak Aktif Card -->

          <!-- Pendapatan Bunga Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total Pendapatan <span>| Bunga</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $bunga->jumlah ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Pendapatan Card -->

          <!-- Jumlah Total Tunggakan Card -->

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Tunggakan <span>| Anggota</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $tidak ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Tidak Aktif Card -->

          <!-- Tabel Anggota Tunggakan -->
          <div class="col-12">

            <div class="card-body">
              <h5 class="card-title">Tunggakan Anggota <span>| Keseluruhan</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Kode Anggota</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Total Tunggakan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tung as $ang) : ?>
                    <tr>
                      <th scope="row"><a href="#"><?= $ang['KODE_ANG']; ?></a></th>
                      <td><?= $ang['NAMA_ANG']; ?></td>
                      <td><a href="#" class="text-primary"><?= $ang['NAMA_INS']; ?></a></td>
                      <td><?= $ang['SIPOKU3']; ?></td>
                      <td><span class="badge bg-success">Lunas</span></td>
                      <!-- <td><span class="badge bg-warning">Belum Lunas</span></td> -->
                      <!-- <td><span class="badge bg-danger">Jatuh Tempo</span></td> -->
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->
      </form>




      <div id="lineChart"></div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#lineChart"), {
      series: [{
        name: "Pinjaman Uang",
        data: [<?=$SPjanuari->jumlah?>, <?=$SPfebruari->jumlah?>, <?=$SPmaret->jumlah?>, <?=$SPapril->jumlah?>, <?=$SPmei->jumlah?>, <?=$SPjuni->jumlah?>, <?=$SPjuli->jumlah?>, <?=$SPagustus->jumlah?>]
      }, {
        name: "Pinjaman Khusus",
        data: [15, 45, 30, 59, 46, 66, 67, 90, 111]
      }, {
        name: "Konsumsi",
        data: [<?=$Kjanuari->jumlah?>, <?=$Kfebruari->jumlah?>, <?=$Kmaret->jumlah?>, <?=$Kapril->jumlah?>, <?=$Kmei->jumlah?>, <?=$Kjuni->jumlah?>, <?=$Kjuli->jumlah?>, <?=$Kagustus->jumlah?>, <?=$Kseptember->jumlah?>, <?=$Koktober->jumlah?>, <?=$Knovember->jumlah?>, <?=$Kdesember->jumlah?>]
      }, {
        name: "Non Konsumsi",
        data: [<?=$NKjanuari->jumlah?>, <?=$NKfebruari->jumlah?>, <?=$NKmaret->jumlah?>, <?=$NKapril->jumlah?>, <?=$NKmei->jumlah?>, <?=$NKjuni->jumlah?>, <?=$NKjuli->jumlah?>, <?=$NKagustus->jumlah?>, <?=$NKseptember->jumlah?>, <?=$NKoktober->jumlah?>, <?=$NKnovember->jumlah?>, <?=$NKdesember->jumlah?>]
      }],
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      markers: {
        size: 4
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
      }
    }).render();
  });
</script>
</div>

    </div>

  </div>
</div><!-- End Reports -->

<?php
$this->load->view('templates/footer');
?>