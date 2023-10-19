<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url(); ?>backend" class="brand-link">
    <span class="brand-text font-weight-light d-flex justify-content-center"><?= title(); ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
        <div class="info">
          <a href="javascript:void(0)" class="d-block"><?= nama_user($this->session->userdata('id_user')); ?></a>
          <span class="badge badge-danger">
            <?= strtoupper($this->session->userdata('level')); ?>
          </span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('backend'); ?>" class="<?php if($this->uri->segment('2') == '') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/pengaduan'); ?>" class="<?php if($this->uri->segment('2') == 'pengaduan' OR $this->uri->segment('2') == 'detail-pengaduan') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-comment"></i>
              <p>PENGADUAN</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/link-terkait'); ?>" class="<?php if($this->uri->segment('2') == 'link-terkait' OR $this->uri->segment('2') == 'tambah-link' OR $this->uri->segment('2') == 'edit-link') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-link"></i>
              <p>LINK TERKAIT</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/agenda'); ?>" class="<?php if($this->uri->segment('2') == 'agenda' OR $this->uri->segment('2') == 'tambah-agenda' OR $this->uri->segment('2') == 'edit-agenda') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-calendar"></i>
              <p>AGENDA</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/pengumuman'); ?>" class="<?php if($this->uri->segment('2') == 'pengumuman' OR $this->uri->segment('2') == 'tambah-pengumuman' OR $this->uri->segment('2') == 'edit-pengumuman') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>PENGUMUMAN</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/berita'); ?>" class="<?php if($this->uri->segment('2') == 'berita' OR $this->uri->segment('2') == 'tambah-berita' OR $this->uri->segment('2') == 'edit-berita') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>BERITA</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/download'); ?>" class="<?php if($this->uri->segment('2') == 'download' OR $this->uri->segment('2') == 'tambah-download' OR $this->uri->segment('2') == 'edit-download') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="nav-icon fas fa-download"></i>
              <p>DOWNLOAD</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/siswa'); ?>" class="<?php if($this->uri->segment('2') == 'siswa' OR $this->uri->segment('2') == 'tambah-siswa' OR $this->uri->segment('2') == 'edit-siswa') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="fa fa-users nav-icon"></i>
              <p>PESERTA DIDIK</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/prestasi-siswa'); ?>" class="<?php if($this->uri->segment('2') == 'prestasi-siswa' OR $this->uri->segment('2') == 'tambah-prestasi-siswa' OR $this->uri->segment('2') == 'edit-prestasi-siswa') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="fa fa-trophy nav-icon"></i>
              <p>PRESTASI SISWA</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/prestasi-guru'); ?>" class="<?php if($this->uri->segment('2') == 'prestasi-guru' OR $this->uri->segment('2') == 'tambah-prestasi-guru' OR $this->uri->segment('2') == 'edit-prestasi-guru') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="fa fa-trophy nav-icon"></i>
              <p>PRESTASI GURU/TENDIK</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('backend/prestasi-sekolah'); ?>" class="<?php if($this->uri->segment('2') == 'prestasi-sekolah' OR $this->uri->segment('2') == 'tambah-prestasi-sekolah' OR $this->uri->segment('2') == 'edit-prestasi-sekolah') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
              <i class="fa fa-trophy nav-icon"></i>
              <p>
              <?php 
              if(jenjang() == 1 OR jenjang() == 2)
              {
                echo'PRESTASI SEKOLAH';
              }else
              {
                echo'PRESTASI MADRASAH';
              }
              ?>
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-list"></i>
              <p>PROFIL
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('backend/profil-web'); ?>" class="<?php if($this->uri->segment('2') == 'profil-web' OR $this->uri->segment('2') == 'edit-profil-web' OR $this->uri->segment('2') == 'logo-web' OR $this->uri->segment('2') == 'logo-admin' OR $this->uri->segment('2') == 'favicon' OR $this->uri->segment('2') == 'gambar-profil' OR $this->uri->segment('2') == 'file') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PROFIL WEBSITE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/banner"); ?>" class="<?php if($this->uri->segment('2') == 'banner' OR $this->uri->segment('2') == 'tambah-banner' OR $this->uri->segment('2') == 'edit-banner') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BANNER WEB</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/sejarah"); ?>" class="<?php if($this->uri->segment('2') == 'sejarah' OR $this->uri->segment('2') == 'edit-sejarah') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEJARAH</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/visi-misi"); ?>" class="<?php if($this->uri->segment('2') == 'visi-misi' OR $this->uri->segment('2') == 'edit-visi-misi') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>VISI & MISI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/struktur-organisasi"); ?>" class="<?php if($this->uri->segment('2') == 'struktur-organisasi' OR $this->uri->segment('2') == 'edit-struktur-organisasi') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>STRUKTUR ORGANISASI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/ekstrakurikuler"); ?>" class="<?php if($this->uri->segment('2') == 'ekstrakurikuler' OR $this->uri->segment('2') == 'tambah-ekstrakurikuler' OR $this->uri->segment('2') == 'edit-ekstrakurikuler') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>EKSTRAKURIKULER</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/sarpras"); ?>" class="<?php if($this->uri->segment('2') == 'sarpras' OR $this->uri->segment('2') == 'edit-sarpras') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SARANA & PRASARANA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/guru"); ?>" class="<?php if($this->uri->segment('2') == 'guru' OR $this->uri->segment('2') == 'tambah-guru' OR $this->uri->segment('2') == 'edit-guru' OR $this->uri->segment('2') == 'detail-guru') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GURU</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("backend/karyawan"); ?>" class="<?php if($this->uri->segment('2') == 'karyawan' OR $this->uri->segment('2') == 'tambah-karyawan' OR $this->uri->segment('2') == 'edit-karyawan' OR $this->uri->segment('2') == 'detail-karyawan') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KARYAWAN</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-book"></i>
              <p>PENDIDIKAN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('backend/tahun-pelajaran'); ?>" class="<?php if($this->uri->segment('2') == 'tahun-pelajaran' OR $this->uri->segment('2') == 'tambah-tahun-pelajaran' OR $this->uri->segment('2') == 'edit-tahun-pelajaran') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>TAHUN PELAJARAN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/kurikulum'); ?>" class="<?php if($this->uri->segment('2') == 'kurikulum' OR $this->uri->segment('2') == 'tambah-kurikulum' OR $this->uri->segment('2') == 'edit-kurikulum') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>STRUKTUR KURIKULUM</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/kalender'); ?>" class="<?php if($this->uri->segment('2') == 'kalender') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>KALENDER AKADEMIK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/rekap-us'); ?>" class="<?php if($this->uri->segment('2') == 'rekap-us' OR $this->uri->segment('2') == 'tambah-rekap-us' OR $this->uri->segment('2') == 'edit-rekap-us') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>REKAP US / UM</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>ALUMNI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('backend/alumni'); ?>" class="<?php if($this->uri->segment('2') == 'alumni' OR $this->uri->segment('2') == 'tambah-alumni' OR $this->uri->segment('2') == 'edit-alumni') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA ALUMNI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/penelusuran-alumni'); ?>" class="<?php if($this->uri->segment('2') == 'penelusuran-alumni' OR $this->uri->segment('2') == 'edit-status') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PENELUSURAN ALUMNI</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>GALLERI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('backend/album'); ?>" class="<?php if($this->uri->segment('2') == 'album' OR $this->uri->segment('2') == 'tambah-album' OR $this->uri->segment('2') == 'edit-album') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ALBUM</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/foto'); ?>" class="<?php if($this->uri->segment('2') == 'foto' OR $this->uri->segment('2') == 'tambah-foto' OR $this->uri->segment('2') == 'edit-foto') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FOTO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/video'); ?>" class="<?php if($this->uri->segment('2') == 'video' OR $this->uri->segment('2') == 'tambah-video' OR $this->uri->segment('2') == 'edit-video') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>VIDEO YOUTUBE</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-users"></i>
              <p>MANAJEMEN USERS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($this->session->userdata('level') == 'superadmin'){ ?>
                <li class="nav-item">
                  <a href="<?= base_url('backend/users'); ?>" class="<?php if($this->uri->segment('2') == 'users' OR $this->uri->segment('2') == 'tambah-user' OR $this->uri->segment('2') == 'edit-user') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>USERS</p>
                  </a>
                </li>
              <?php } ?>
              <li class="nav-item">
                <a href="<?= base_url('backend/edit-profil'); ?>" class="<?php if($this->uri->segment('2') == 'edit-profil') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>EDIT PROFIL</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('backend/ganti-password'); ?>" class="<?php if($this->uri->segment('2') == 'ganti-password') { echo 'nav-link active'; }else{ echo 'nav-link'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GANTI PASSWORD</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
  </div>
</aside>