  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/dashboard">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/anggota">
                  <i class="bi bi-people-fill"></i>
                  <span>Anggota</span>
              </a>
          </li>
		  <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/Historipembayaran">
                  <i class="bi bi-book"></i>
                  <span>Histori Pembayaran</span>
              </a>
          </li> -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinjaman">
                  <i class="bi bi-bank"></i>
                  <span>Pinjaman</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-navsp" aria-controls="forms-nav">
                  <i class="bi bi-gear-wide-connected"></i><span>Simpan Pinjam</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-navsp" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinsim">
                          <i class="bi bi-circle-fill"></i><span>Simpanan</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinsim/pinjaman">
                          <i class="bi bi-circle-fill"></i><span>Pinjaman</span>
                      </a>
                  </li>
                  <!-- <li class="nav-item">
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinsim/tunggakan">
                          <i class="bi bi-circle-fill"></i><span>Tunggakan</span>
                      </a>
                  </li> -->
              </ul>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#tunggakan" aria-controls="forms-nav">
                  <i class="bi bi-gear-wide-connected"></i><span>Tunggakan</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="tunggakan" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/tunggakan">
                          <i class="bi bi-circle-fill"></i><span>Instansi</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/tunggakan/anggota">
                          <i class="bi bi-circle-fill"></i><span>Anggota</span>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#kantor" aria-controls="forms-nav">
                  <i class="bi bi-gear-wide-connected"></i><span>Kantor</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="kantor" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/kantor">
                          <i class="bi bi-circle-fill"></i><span>Pembayaran</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/kantor/instansi">
                          <i class="bi bi-circle-fill"></i><span>Instansi</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/tagihan">
                  <i class="bi bi-bank2"></i>
                  <span>Tagihan</span>
              </a>
          </li> -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pay">
                  <i class="bi bi-cash-coin"></i>
                  <span>Pembayaran Langsung</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pay/cetak">
                  <i class="bi bi-printer"></i>
                  <span>Cetak Pembayaran</span>
              </a>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate">
                  <i class="bi bi-cash"></i>
                  <span>Generate</span>
              </a>
          </li> -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav-gen2" aria-controls="forms-nav">
                  <i class="bi bi-cash"></i><span>Penyesuaian</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav-gen2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2">
                          <i class="bi bi-circle-fill"></i><span>Simpanan</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/pinjaman">
                          <i class="bi bi-circle-fill"></i><span>Pinjaman</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/tagihan">
                          <i class="bi bi-circle-fill"></i><span>Tagihan</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav-gen2" aria-controls="forms-nav">
                  <i class="bi bi-cash"></i><span>Generate2</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav-gen2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2">
                          <i class="bi bi-circle-fill"></i><span>Pinjam Simpan</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/uang">
                          <i class="bi bi-circle-fill"></i><span>Uang</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/nonkonsum">
                          <i class="bi bi-circle-fill"></i><span>Non Konsumsi</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/konsum">
                          <i class="bi bi-circle-fill"></i><span>Konsumsi</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate2/khusus">
                          <i class="bi bi-circle-fill"></i><span>Khusus</span>
                      </a>
                  </li>
              </ul>
          </li> -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav" aria-controls="forms-nav">
                  <i class="bi bi-gear-wide-connected"></i><span>Export/Import/print</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/keuangan/">
                          <i class="bi bi-circle-fill"></i><span>Export Excel</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/Import">
                          <i class="bi bi-circle-fill"></i><span>Import Bank Jatim</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/keuangan/cetakins/">
                          <i class="bi bi-circle-fill"></i><span>Cetak Instansi</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/keuangan/cetakang/">
                          <i class="bi bi-circle-fill"></i><span>Cetak Anggota</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Forms Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav-gen" aria-controls="forms-nav">
                  <i class="bi bi-three-dots-vertical"></i><span>Option</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav-gen" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/">
                          <i class="bi bi-circle-fill"></i><span>User</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/Pengurus">
                          <i class="bi bi-circle-fill"></i><span>Pengurus</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/instansi">
                          <i class="bi bi-circle-fill"></i><span>Instansi</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/anggota/keluar">
                          <i class="bi bi-circle-fill"></i><span>Anggota Berhenti</span>
                      </a>
                  </li>
              </ul>
          </li>


  </aside><!-- End Sidebar-->