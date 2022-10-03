  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="#">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/">
                  <i class="bi bi-grid"></i>
                  <span>User</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/anggota">
                  <i class="bi bi-grid"></i>
                  <span>Anggota</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/instansi">
                  <i class="bi bi-grid"></i>
                  <span>Instansi</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/keuangan">
                  <i class="bi bi-grid"></i>
                  <span>Simpan Pinjam</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav" aria-expanded="false" aria-controls="forms-nav">
                  <i class="bi bi-journal-text"></i><span>Keuangan</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="<?= base_url(); ?>index.php/kirim/">
                          <i class="bi bi-circle"></i><span>Export Excel</span>
                      </a>
                  </li>
                  <li>
                      <a href="<?= base_url(); ?>index.php/kirim/cetakins/">
                          <i class="bi bi-circle"></i><span>Cetak Instansi</span>
                      </a>
                  </li>
                  <li>
                      <a href="#">
                          <i class="bi bi-circle"></i><span>Cetak Anggota</span>
                      </a>
                  </li>

              </ul>
          </li><!-- End Forms Nav -->
      </ul>

  </aside><!-- End Sidebar-->