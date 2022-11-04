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
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/">
                  <i class="bi bi-person-circle"></i>
                  <span>User</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/anggota">
                  <i class="bi bi-people-fill"></i>
                  <span>Anggota</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/instansi">
                  <i class="bi bi-building"></i>
                  <span>Instansi</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinjaman">
                  <i class="bi bi-bank2"></i>
                  <span>Pinjaman</span>
              </a>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/transaksi">
                  <i class="bi bi-bank2"></i>
                  <span>Transaksi</span>
              </a>
          </li> -->
          
          <li class="nav-item">
              <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/pinsim">
                  <i class="bi bi-bank2"></i>
                  <span>Simpan Pinjam</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav-gen" aria-controls="forms-nav">
                  <i class="bi bi-cash-stack"></i><span>Generate</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav-gen" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate">
                          <i class="bi bi-circle-fill"></i><span>pinsimp</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate/uang">
                          <i class="bi bi-circle-fill"></i><span>Uang</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate/nonkonsum">
                          <i class="bi bi-circle-fill"></i><span>Non Konsum</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate/konsum">
                          <i class="bi bi-circle-fill"></i><span>Konsum</span>
                      </a>
                  </li>
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/generate/khusus">
                          <i class="bi bi-circle-fill"></i><span>khusus</span>
                      </a>
                  </li>
              </ul>
          </li>
          
          <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#forms-nav" aria-controls="forms-nav">
                  <i class="bi bi-cash-stack"></i><span>Keuangan</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                  <li>
                      <a class="nav-link collapsed" href="<?= base_url(); ?>index.php/keuangan/">
                          <i class="bi bi-circle-fill"></i><span>Export Excel</span>
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
          
      </ul>

  </aside><!-- End Sidebar-->