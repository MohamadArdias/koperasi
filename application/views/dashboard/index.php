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
                    <h6>Rp. <?= number_format($tunggakan->jumlah, 0, ',', '.') ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Tidak Aktif Card -->

          <!-- Tabel Anggota Tunggakan -->
          <div class="col-12">

            <div class="card-body">
              <h5 class="card-title">Tunggakan Anggota <span>| Keseluruhan</span></h5>

              <table class="table table-borderless datatable" id="customers">
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
                      <td scope="row"><?= $ang['KODE_ANG']; ?></td>
                      <td><?= $ang['NAMA_ANG']; ?></td>
                      <td><?= $ang['NAMA_INS']; ?></td>
                      <td style="text-align: right"><?= number_format($ang['TUNGGAKAN'], 0, ',', '.') ?></td>
                      <td><span class="badge bg-danger">Belum Lunas</span></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->
      </form>

      <select id="thn" onchange="a()" class="form-select col-md-2" aria-label="Default select example">
        <option hidden> pilih tahun </option>
        <?php
        $lg = $this->db->query("SELECT DISTINCT YEAR(TANGGAL) AS TANG FROM us ORDER BY YEAR(TANGGAL) ASC")->result_array();
        foreach ($lg as $key) {
        ?>
          <option value="<?= $key['TANG']; ?>"><?= $key['TANG']; ?></option>
        <?php
        }
        ?>

      </select>

      <div id="lineChart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new ApexCharts(document.querySelector("#lineChart"), {
            series: [{
              name: 'Jumlah Pinjaman',
              data: [<?php foreach ($data as $key) {
                        echo $key['HASIL'];  ?>, <?php
                                                } ?>],
            }],
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: true
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
              type: 'date',
              categories: [<?php foreach ($data as $key) { ?> "<?= $key['TANGGAL']; ?>",
                <?php   } ?>
              ]
            }
          }).render();
        });
      </script>

      <script>
        function a() {
          var option = document.getElementById("thn").value;
          console.log(option);
          window.location.assign("?TAHUN=" + option);
        }
      </script>
    </div>

  </div>

</div>
</div><!-- End Reports -->

<?php
$this->load->view('templates/footer');
?>