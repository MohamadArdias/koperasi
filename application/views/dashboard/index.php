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
                    <h6><?= $bunga ?></h6>
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



      <div id="reportsChart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#reportsChart"), {
            series: [{
              name: 'Sales',
              data: [31, 40, 28, 51, 42, 82, 56],
            }, {
              name: 'Revenue',
              data: [11, 32, 45, 32, 34, 52, 41]
            }, {
              name: 'Customers',
              data: [15, 11, 32, 18, 9, 24, 11]
            }],
            chart: {
              height: 350,
              type: 'area',
              toolbar: {
                show: false
              },
            },
            markers: {
              size: 4
            },
            colors: ['#4154f1', '#2eca6a', '#ff771d'],
            fill: {
              type: "gradient",
              gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.4,
                stops: [0, 90, 100]
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'smooth',
              width: 2
            },
            xaxis: {
              type: 'datetime',
              categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
            },
            tooltip: {
              x: {
                format: 'dd/MM/yy HH:mm'
              },
            }
          }).render();
        });
      </script>
      <!-- End Line Chart -->

    </div>

  </div>
</div><!-- End Reports -->

<?php
$this->load->view('templates/footer');
?>