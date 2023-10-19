<?php 
function pesan_sukses($str)
{
   return "<script type='text/javascript'>
               setTimeout(function () { 
                  swal({
                     position: 'top-end',
                     icon: 'success',
                     title: '$str',
                     timer: 1500
                  });
               },2000); 
            </script>";
}

function pesan_gagal($str)
{
   return "<script type='text/javascript'>
               setTimeout(function () { 
                  swal({
                     position: 'top-end',
                     icon: 'error',
                     title: '$str',
                     timer: 5000
                  });
               },2000); 
            </script>";
}

function tgl_simpan_sekarang()
{
   date_default_timezone_set('Asia/Jakarta');
   return date('Y-m-d');
}

function tgl_jam_simpan_sekarang()
{
   date_default_timezone_set('Asia/Jakarta');
   return date('Y-m-d H:i:s');
}

function is_email($str)
{
   return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function is_url($str)
{
   return preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$str);
}
   
function cetak($str)
{
   return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
}
   
function title()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,nama_web')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['nama_web'];
}

function meta_description()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,meta_description')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['meta_description'];
}

function meta_keyword()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,meta_keyword')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['meta_keyword'];
}

function logo_web()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,logo_web')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['logo_web'];
}

function alamat()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,alamat')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['alamat'];
}

function jenjang()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,jenjang')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['jenjang'];
}

function email()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,email')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['email'];
}

function telp()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,telp')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['telp'];
}

function whatsapp()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,whatsapp')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['whatsapp'];
}

function facebook()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,facebook')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['facebook'];
}

function twitter()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,twitter')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['twitter'];
}

function instagram()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,instagram')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['instagram'];
}

function youtube()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,youtube')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['youtube'];
}

function favicon()
{
   $ci = & get_instance();
   $q = $ci->db->select('id,favicon')->from('tb_profil')->where('id',1)->get()->row_array();
   return $q['favicon'];
}

function nama_user($id_user)
{
   $ci = & get_instance();
   $q = $ci->db->select('id_user,nama')->from('tb_user')->where('id_user',$id_user)->get()->row_array();
   return $q['nama'];
}

function link_aktif()
{
   $ci = & get_instance();
   return $ci->db->select('*')->from('tb_link')->where('is_active',1)->order_by('nama','asc')->get()->result();
}

function get_foto($id_album)
{
   $ci = & get_instance();
   $q = $ci->db->select('id_foto,id_album,foto')->from('tb_foto')->where('id_album',$id_album)->order_by('id_foto','asc')->limit(1,0)->get()->row_array();
   return $q['foto'];
}

function jml_foto($id_album)
{
   $ci = & get_instance();
   return $ci->db->select('id_foto,id_album')->from('tb_foto')->where('id_album',$id_album)->get()->num_rows();
}

function tgl_indo($tgl)
{
   $tanggal = substr($tgl,8,2);
   $bulan = getBulan(substr($tgl,5,2));
   $tahun = substr($tgl,0,4);
   return $tanggal.' '.$bulan.' '.$tahun;       
} 

function tgl_simpan($tgl)
{  
   $tanggal = substr($tgl,0,2);
   $bulan = substr($tgl,3,2);
   $tahun = substr($tgl,6,4);
   return $tahun.'-'.$bulan.'-'.$tanggal;     
}

function tgl_view($tgl)
{
   $tanggal = substr($tgl,8,2);
   $bulan = substr($tgl,5,2);
   $tahun = substr($tgl,0,4);
   return $tanggal.'-'.$bulan.'-'.$tahun;       
}

function tgl_view_excel($tgl)
{
   $tanggal = substr($tgl,3,2);
   $bulan = substr($tgl,0,2);
   $tahun = substr($tgl,6,4);
   return $tanggal.'-'.$bulan.'-'.$tahun;       
}

function seo_title($s)
{
   $c = array (' ');
   $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
   $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
   $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
   return $s;
}

function slug($text)
{
   // replace non letter or digits by -
   $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

   // trim
   $text = trim($text, '-');

   // transliterate
   $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

   // lowercase
   $text = strtolower($text);

   // remove unwanted characters
   $text = preg_replace('~[^-\w]+~', '', $text);
   if (empty($text)){
      return 'n-a';
   }
   return $text;
}

function hari_indo($hari)
{
   switch($hari)
   {
      case 'Sun':
         $hari_ini = "Minggu";
         break;
      case 'Mon':			
         $hari_ini = "Senin";
         break;
      case 'Tue':
         $hari_ini = "Selasa";
         break;
      case 'Wed':
         $hari_ini = "Rabu";
         break;
      case 'Thu':
         $hari_ini = "Kamis";
         break;
      case 'Fri':
         $hari_ini = "Jum'at";
         break;
      case 'Sat':
         $hari_ini = "Sabtu";
         break;
      default:
         $hari_ini = "Hari tidak diketahui";		
   }
   return $hari_ini;
}

function hari_ini_indo()
{
   $hari = date('D');
   switch($hari)
   {
      case 'Sun':
         $hari_ini = "Minggu";
         break;
      case 'Mon':			
         $hari_ini = "Senin";
         break;
      case 'Tue':
         $hari_ini = "Selasa";
         break;
      case 'Wed':
         $hari_ini = "Rabu";
         break;
      case 'Thu':
         $hari_ini = "Kamis";
         break;
      case 'Fri':
         $hari_ini = "Jum'at";
         break;
      case 'Sat':
         $hari_ini = "Sabtu";
         break;
      default:
         $hari_ini = "Hari tidak diketahui";		
   }
   return $hari_ini;
}

function getTanggal($tgl)
{
   switch($tgl)
   {
      case '01':
         $tanggal = 'Satu';
         break;
      case '02':
         $tanggal = 'Dua';
         break;
      case '03':
         $tanggal = 'Tiga';
         break;
      case '04':
         $tanggal = 'Empat';
         break;
      case '05':
         $tanggal = 'Lima';
         break;
      case '06':
         $tanggal = 'Enam';
         break;
      case '07':
         $tanggal = 'Tujuh';
         break;
      case '08':
         $tanggal = 'Delapan';
         break;
      case '09':
         $tanggal = 'Sembilan';
         break;
      case '10':
         $tanggal = 'Sepuluh';
         break;
      case '11':
         $tanggal = 'Sebelas';
         break;
      case '12':
         $tanggal = 'Dua Belas';
         break;
      case '13':
         $tanggal = 'Tiga Belas';
         break;
      case '14':
         $tanggal = 'Empat Belas';
         break;
      case '15':
         $tanggal = 'Lima Belas';
         break;
      case '16':
         $tanggal = 'Enam Belas';
         break;
      case '17':
         $tanggal = 'Tujuh Belas';
         break;
      case '18':
         $tanggal = 'Delapan Belas';
         break;
      case '19':
         $tanggal = 'Sembilan Belas';
         break;
      case '20':
         $tanggal = 'Dua Puluh';
         break;
      case '21':
         $tanggal = 'Dua Puluh Satu';
         break;
      case '22':
         $tanggal = 'Dua Puluh Dua';
         break;
      case '23':
         $tanggal = 'Dua Puluh Tiga';
         break;
      case '24':
         $tanggal = 'Dua Puluh Empat';
         break;
      case '25':
         $tanggal = 'Dua Puluh Lima';
         break;
      case '26':
         $tanggal = 'Dua Puluh Enam';
         break;
      case '27':
         $tanggal = 'Dua Puluh Tujuh';
         break;
      case '28':
            $tanggal = 'Dua Puluh Delapan';
            break;
      case '29':
            $tanggal = 'Dua Puluh Sembilan';
            break;
      case '30':
            $tanggal = 'Tiga Puluh';
            break;
      case '31':
            $tanggal = 'Tiga Puluh Satu';
            break;
   } 
   return $tanggal;
}

function getBulan($bln)
{
   switch($bln)
   {
      case '01':
         $bulan = 'Januari';
         break;
      case '02':
         $bulan = 'Februari';
         break;
      case '03':
         $bulan = 'Maret';
         break;
      case '04':
         $bulan = 'April';
         break;
      case '05':
         $bulan = 'Mei';
         break;
      case '06':
         $bulan = 'Juni';
         break;
      case '07':
         $bulan = 'Juli';
         break;
      case '08':
         $bulan = 'Agustus';
         break;
      case '09':
         $bulan = 'September';
         break;
      case '10':
         $bulan = 'Oktober';
         break;
      case '11':
         $bulan = 'November';
         break;
      case '12':
         $bulan = 'Desember';
         break;
   } 
   return $bulan;
}
   
function getTahun($thn)
{
   switch($thn)
   {
      case '2018':
         $tahun = 'Dua Ribu Delapan Belas';
         break;
      case '2019':
         $tahun = 'Dua Ribu Sembilan Belas';
         break;
      case '2020':
         $tahun = 'Dua Ribu Dua Puluh';
         break;
      case '2021':
         $tahun = 'Dua Ribu Dua Puluh Satu';
         break;
      case '2022':
         $tahun = 'Dua Ribu Dua Puluh Dua';
         break;
      case '2023':
         $tahun = 'Dua Ribu Dua Puluh Tiga';
         break;
      case '2024':
         $tahun = 'Dua Ribu Dua Puluh Empat';
         break;
      case '2025':
         $tahun = 'Dua Ribu Dua Puluh Lima';
         break;
   }
   return $tahun;
}