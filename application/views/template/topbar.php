<body>
<div class="preloader d-flex align-items-center justify-content-center">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<section class="sticky-top bg-white">
  <nav class="container navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo/<?= logo_web(); ?>" class="img img-fluid" style="object-fit:contain; max-height:45px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" style="font-size: 11pt">
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= base_url(); ?>"><b>Home</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Berita</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>berita">Berita</a>
            <a class="dropdown-item" href="<?= base_url(); ?>agenda">Agenda</a>
            <a class="dropdown-item" href="<?= base_url(); ?>pengumuman">Pengumuman</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Profil</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>profil">Profil</a>
            <a class="dropdown-item" href="<?= base_url(); ?>profil/sejarah">Sejarah</a>
            <a class="dropdown-item" href="<?= base_url(); ?>profil/visi-misi">Visi & Misi</a>
            <a class="dropdown-item" href="<?= base_url(); ?>profil/struktur-organisasi">Struktur Organisasi</a>
            <a class="dropdown-item" href="<?= base_url(); ?>guru">Tenaga Edukatif</a>
            <a class="dropdown-item" href="<?= base_url(); ?>karyawan">Tenaga Non Edukatif</a>
            <a class="dropdown-item" href="<?= base_url(); ?>profil/sarpras">Sarana Prasarana</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Pendidikan</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>pendidikan/kurikulum">Struktur Kurikulum</a>
            <a class="dropdown-item" href="<?= base_url(); ?>pendidikan/kalender">Kalender Akademik</a>
            <a class="dropdown-item" href="<?= base_url(); ?>pendidikan/rekap-us">
              <?php
              if(jenjang() == 1 OR jenjang() == 2)
              {
                echo'Rekap Ujian Sekolah';
              }elseif(jenjang() == 3 OR jenjang() == 4)
              {
                echo'Rekap Ujian Madrasah';
              }
              ?>
            </a>
            <a class="dropdown-item" href="<?= base_url(); ?>ekstrakurikuler">Ekstrakurikuler</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= base_url(); ?>peserta-didik"><b>Peserta Didik</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Prestasi</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
            if(jenjang() == 1 OR jenjang() == 2)
            { 
              echo'<a class="dropdown-item" href="'.base_url('prestasi/prestasi-sekolah').'"> Prestasi Sekolah</a>';
            }else
            {
              echo'<a class="dropdown-item" href="'.base_url('prestasi/prestasi-madrasah').'"> Prestasi Madrasah</a>';
            }
            ?>
            <a class="dropdown-item" href="<?= base_url(); ?>prestasi/prestasi-siswa">Prestasi Siswa</a>
            <a class="dropdown-item" href="<?= base_url(); ?>prestasi/prestasi-guru">Prestasi Guru</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Alumni</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>alumni">Data Alumni</a>
            <a class="dropdown-item" href="<?= base_url(); ?>alumni/penelusuran-alumni">Penelusuran Alumni</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>Galeri</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= base_url(); ?>galeri/foto">Foto</a>
            <a class="dropdown-item" href="<?= base_url(); ?>galeri/video">Video</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <b>SIM</b>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach(link_aktif() as $r_link): ?>
              <?php if(is_url($r_link->link)){ ?>          
                <a class="dropdown-item" href="<?= $r_link->link; ?>" target="_blank"><?= $r_link->nama; ?></a>
              <?php } ?>
            <?php endforeach; ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= base_url(); ?>download"><b>Download</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="<?= base_url(); ?>pengaduan"><b>Pengaduan</b></a>
        </li>
      </ul>
    </div>
  </nav>
</section>
<div class="bg-theme p-1"></div>