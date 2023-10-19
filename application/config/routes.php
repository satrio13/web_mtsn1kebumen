<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route = array(
    'default_controller' => 'main', //start web
    //'quran' => 'quran',
    //'quran/surah/(:num)' => 'quran/surah/$1',
    'agenda' => 'agenda',
    'agenda/detail/(:any)' => 'agenda/detail/$1',
    'pengumuman' => 'pengumuman',
    'pengumuman/detail/(:any)' => 'pengumuman/detail/$1',
    'berita' => 'berita',
    'berita/page/(:num)' => 'berita/index/$1',
    'berita/detail/(:any)' => 'berita/detail/$1',
    'alumni' => 'alumni',
    'alumni/isi-alumni' => 'alumni/isi-alumni', 
    'alumni/penelusuran-alumni' => 'alumni/penelusuran-alumni',   
    'profil' => 'profil',
    'profil/sejarah' => 'profil/sejarah',
    'profil/visi-misi' => 'profil/visi-misi',
    'profil/struktur-organisasi' => 'profil/struktur-organisasi',
    'ekstrakurikuler' => 'profil/ekstrakurikuler',
    'ekstrakurikuler/detail/(:any)' => 'profil/detail-ekstrakurikuler/$1',
    'profil/sarpras' => 'profil/sarpras',
    'guru' => 'guru',
    'guru/get_data_guru' => 'guru/get_data_guru',
    'guru/detail/(:num)' => 'guru/detail/$1',
    'karyawan' => 'karyawan',
    'karyawan/get_data_karyawan' => 'karyawan/get_data_karyawan',
    'karyawan/detail-karyawan/(:num)' => 'karyawan/detail-karyawan/$1',
    'program/paud' => 'program/paud',
    'program/paket-a' => 'program/paket-a',
    'program/paket-b' => 'program/paket-b',
    'program/paket-c' => 'program/paket-c',
    'program/kursus' => 'program/kursus',
    'pendidikan/kurikulum' => 'pendidikan/kurikulum',
    'pendidikan/kalender' => 'pendidikan/kalender',
    'pendidikan/rekap-us' => 'pendidikan/rekap-us',
    'peserta-didik' => 'siswa',
    'prestasi-siswa' => 'prestasi/prestasi-siswa',
    'prestasi/get_data_prestasi_siswa' => 'prestasi/get_data_prestasi_siswa',
    'prestasi-guru' => 'prestasi/prestasi-guru',
    'prestasi/get_data_prestasi_guru' => 'prestasi/get_data_prestasi_guru',
    'prestasi-sekolah' => 'prestasi/prestasi-sekolah',
    'prestasi-madrasah' => 'prestasi/prestasi-madrasah',
    'prestasi/get_data_prestasi_sekolah' => 'prestasi/get_data_prestasi_sekolah',
    'download' => 'download',
    'galeri/foto' => 'galeri/foto',
    'galeri/album/(:any)' => 'galeri/album/$1', 
    'galeri/video' => 'galeri/video', 
    'pengaduan' => 'pengaduan', //end web
    'auth' => 'admin/auth', //start backend
    'auth/login' => 'admin/auth/login',
    'auth/logout' => 'admin/auth/logout',
    'backend' => 'admin/backend',
    'backend/pengaduan' => 'admin/pengaduan',
    'backend/get_data_pengaduan' => 'admin/pengaduan/get_data_pengaduan',
    'backend/detail-pengaduan/(:num)' => 'admin/pengaduan/detail-pengaduan/$1',
    'backend/lihat-pengaduan/(:num)' => 'admin/pengaduan/lihat-pengaduan/$1',
    'backend/hapus-pengaduan/(:num)' => 'admin/pengaduan/hapus-pengaduan/$1',
    'backend/banner' => 'admin/banner',
    'backend/get_data_banner' => 'admin/banner/get_data_banner',
    'backend/tambah-banner' => 'admin/banner/tambah-banner',
    'backend/edit-banner/(:num)' => 'admin/banner/edit-banner/$1',
    'backend/hapus-banner/(:num)' => 'admin/banner/hapus-banner/$1', 
    'backend/profil-web' => 'admin/profil',
    'backend/edit-profil-web' => 'admin/profil/edit-profil-web',
    'backend/logo-web' => 'admin/profil/logo-web',
    'backend/logo-admin' => 'admin/profil/logo-admin',
    'backend/favicon' => 'admin/profil/favicon',
    'backend/gambar-profil' => 'admin/profil/gambar-profil',
    'backend/file' => 'admin/profil/file',
    'backend/sejarah' => 'admin/sejarah',
    'backend/edit-sejarah' => 'admin/sejarah/edit-sejarah',
    'backend/visi-misi' => 'admin/visi-misi',
    'backend/edit-visi-misi' => 'admin/visi-misi/edit-visi-misi',
    'backend/struktur-organisasi' => 'admin/struktur-organisasi',
    'backend/edit-struktur-organisasi' => 'admin/struktur-organisasi/edit-struktur-organisasi',
    'backend/ekstrakurikuler' => 'admin/ekstrakurikuler',
    'backend/tambah-ekstrakurikuler' => 'admin/ekstrakurikuler/tambah-ekstrakurikuler',
    'backend/edit-ekstrakurikuler/(:num)' => 'admin/ekstrakurikuler/edit-ekstrakurikuler/$1',
    'backend/hapus-ekstrakurikuler/(:num)' => 'admin/ekstrakurikuler/hapus-ekstrakurikuler/$1',
    'backend/sarpras' => 'admin/sarpras',
    'backend/edit-sarpras' => 'admin/sarpras/edit-sarpras',
    'backend/guru' => 'admin/guru',
    'backend/get_data_guru' => 'admin/guru/get_data_guru',
    'backend/tambah-guru' => 'admin/guru/tambah-guru',
    'backend/edit-guru/(:num)' => 'admin/guru/edit-guru/$1',
    'backend/detail-guru/(:num)' => 'admin/guru/detail-guru/$1',
    'backend/lihat-guru/(:num)' => 'admin/guru/lihat-guru/$1',
    'backend/hapus-guru/(:num)' => 'admin/guru/hapus-guru/$1',
    'backend/karyawan' => 'admin/karyawan',
    'backend/get_data_karyawan' => 'admin/karyawan/get_data_karyawan',
    'backend/tambah-karyawan' => 'admin/karyawan/tambah-karyawan',
    'backend/edit-karyawan/(:num)' => 'admin/karyawan/edit-karyawan/$1',
    'backend/detail-karyawan/(:num)' => 'admin/karyawan/detail-karyawan/$1',
    'backend/lihat-karyawan/(:num)' => 'admin/karyawan/lihat-karyawan/$1',
    'backend/hapus-karyawan/(:num)' => 'admin/karyawan/hapus-karyawan/$1',
    'backend/link-terkait' => 'admin/link',
    'backend/tambah-link' => 'admin/link/tambah-link',
    'backend/edit-link/(:num)' => 'admin/link/edit-link/$1',
    'backend/hapus-link/(:num)' => 'admin/link/hapus-link/$1',
    'backend/agenda' => 'admin/agenda',
    'backend/get_data_agenda' => 'admin/agenda/get_data_agenda',
    'backend/tambah-agenda' => 'admin/agenda/tambah-agenda',
    'backend/edit-agenda/(:num)' => 'admin/agenda/edit-agenda/$1',
    'backend/hapus-agenda/(:num)' => 'admin/agenda/hapus-agenda/$1',
    'backend/pengumuman' => 'admin/pengumuman',
    'backend/get_data_pengumuman' => 'admin/pengumuman/get_data_pengumuman',
    'backend/tambah-pengumuman' => 'admin/pengumuman/tambah-pengumuman',
    'backend/edit-pengumuman/(:num)' => 'admin/pengumuman/edit-pengumuman/$1',
    'backend/hapus-pengumuman/(:num)' => 'admin/pengumuman/hapus-pengumuman/$1',
    'backend/berita' => 'admin/berita',
    'backend/get_data_berita' => 'admin/berita/get_data_berita',
    'backend/tambah-berita' => 'admin/berita/tambah-berita',
    'backend/edit-berita/(:num)' => 'admin/berita/edit-berita/$1',
    'backend/hapus-berita/(:num)' => 'admin/berita/hapus-berita/$1',
    'backend/download' => 'admin/download',
    'backend/get_data_download' => 'admin/download/get_data_download',
    'backend/tambah-download' => 'admin/download/tambah-download',
    'backend/edit-download/(:num)' => 'admin/download/edit-download/$1',
    'backend/hapus-download/(:num)' => 'admin/download/hapus-download/$1',
    'backend/tahun-pelajaran' => 'admin/tahun',
    'backend/tambah-tahun-pelajaran' => 'admin/tahun/tambah-tahun-pelajaran',
    'backend/edit-tahun-pelajaran/(:num)' => 'admin/tahun/edit-tahun-pelajaran/$1',
    'backend/hapus-tahun-pelajaran/(:num)' => 'admin/tahun/hapus-tahun-pelajaran/$1',
    'backend/alumni' => 'admin/alumni',
    'backend/tambah-alumni' => 'admin/alumni/tambah-alumni',
    'backend/edit-alumni/(:num)' => 'admin/alumni/edit-alumni/$1',
    'backend/hapus-alumni/(:num)' => 'admin/alumni/hapus-alumni/$1',
    'backend/penelusuran-alumni' => 'admin/alumni/penelusuran-alumni',
    'backend/get_data_isialumni' => 'admin/alumni/get_data_isialumni',
    'backend/edit-status/(:num)' => 'admin/alumni/edit-status/$1',
    'backend/status/(:num)' => 'admin/alumni/status/$1',
    'backend/save-status' => 'admin/alumni/save-status',
    'backend/lihat-alumni/(:num)' => 'admin/alumni/lihat-alumni/$1',
    'backend/hapus-isialumni/(:num)' => 'admin/alumni/hapus-isialumni/$1',
    'backend/download' => 'admin/download',
    'backend/get_data_download' => 'admin/download/get_data_download',
    'backend/tambah-download' => 'admin/download/tambah-download',
    'backend/edit-download/(:num)' => 'admin/download/edit-download/$1',
    'backend/hapus-download/(:num)' => 'admin/download/hapus-download/$1',
    'backend/kurikulum' => 'admin/kurikulum',
    'backend/tambah-kurikulum' => 'admin/kurikulum/tambah-kurikulum',
    'backend/edit-kurikulum/(:num)' => 'admin/kurikulum/edit-kurikulum/$1',
    'backend/hapus-kurikulum/(:num)' => 'admin/kurikulum/hapus-kurikulum/$1',
    'backend/kalender' => 'admin/kalender',
    'backend/rekap-us' => 'admin/us',
    'backend/get_data_us' => 'admin/us/get_data_us',
    'backend/tambah-rekap-us' => 'admin/us/tambah-rekap-us',
    'backend/edit-rekap-us/(:num)' => 'admin/us/edit-rekap-us/$1',
    'backend/hapus-rekap-us/(:num)' => 'admin/us/hapus-rekap-us/$1',
    'backend/siswa' => 'admin/siswa',
    'backend/tambah-siswa' => 'admin/siswa/tambah-siswa',
    'backend/edit-siswa/(:num)' => 'admin/siswa/edit-siswa/$1',
    'backend/hapus-siswa/(:num)' => 'admin/siswa/hapus-siswa/$1',
    'backend/prestasi-siswa' => 'admin/prestasi-siswa',
    'backend/get_data_prestasi_siswa' => 'admin/prestasi-siswa/get_data_prestasi_siswa',
    'backend/tambah-prestasi-siswa' => 'admin/prestasi-siswa/tambah-prestasi-siswa',
    'backend/edit-prestasi-siswa/(:num)' => 'admin/prestasi-siswa/edit-prestasi-siswa/$1',
    'backend/hapus-prestasi-siswa/(:num)' => 'admin/prestasi-siswa/hapus-prestasi-siswa/$1',
    'backend/prestasi-guru' => 'admin/prestasi-guru',
    'backend/get_data_prestasi_guru' => 'admin/prestasi-guru/get_data_prestasi_guru',
    'backend/tambah-prestasi-guru' => 'admin/prestasi-guru/tambah-prestasi-guru',
    'backend/edit-prestasi-guru/(:num)' => 'admin/prestasi-guru/edit-prestasi-guru/$1',
    'backend/hapus-prestasi-guru/(:num)' => 'admin/prestasi-guru/hapus-prestasi-guru/$1',
    'backend/prestasi-sekolah' => 'admin/prestasi-sekolah',
    'backend/get_data_prestasi_sekolah' => 'admin/prestasi-sekolah/get_data_prestasi_sekolah',
    'backend/tambah-prestasi-sekolah' => 'admin/prestasi-sekolah/tambah-prestasi-sekolah',
    'backend/edit-prestasi-sekolah/(:num)' => 'admin/prestasi-sekolah/edit-prestasi-sekolah/$1',
    'backend/hapus-prestasi-sekolah/(:num)' => 'admin/prestasi-sekolah/hapus-prestasi-sekolah/$1',
    'backend/album' => 'admin/album',
    'backend/tambah-album' => 'admin/album/tambah-album',
    'backend/edit-album/(:num)' => 'admin/album/edit-album/$1',
    'backend/hapus-album/(:num)' => 'admin/album/hapus-album/$1',
    'backend/foto' => 'admin/foto',
    'backend/get_data_foto' => 'admin/foto/get_data_foto',
    'backend/hapus-foto/(:num)' => 'admin/foto/hapus-foto/$1',
    'backend/video' => 'admin/video',
    'backend/tambah-video' => 'admin/video/tambah-video',
    'backend/edit-video/(:num)' => 'admin/video/edit-video/$1',
    'backend/get_data_video' => 'admin/video/get_data_video',
    'backend/hapus-video/(:num)' => 'admin/video/hapus-video/$1',
    'backend/users' => 'admin/user',
    'backend/tambah-user' => 'admin/user/tambah-user',
    'backend/edit-user/(:num)' => 'admin/user/edit-user/$1',
    'backend/hapus-user/(:num)' => 'admin/user/hapus-user/$1',
    'backend/edit-profil' => 'admin/user/edit-profil',
    'backend/ganti-password' => 'admin/user/ganti-password' // end backend
);
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;