<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_banner()
    {
        return $this->db->select('*')->from('tb_banner')->where('is_active',1)->order_by('id','desc')->get();
    }

    function tampil_agenda()
    {
        return $this->db->select('*')->from('tb_agenda')->order_by('id','desc')->limit(3,0)->get();
    }

    function tampil_pengumuman()
    {
        return $this->db->select('*')->from('tb_pengumuman')->where('is_active',1)->order_by('id','desc')->limit(4,0)->get();
    }

    function tampil_berita()
    {
        return $this->db->select('*')->from('tb_berita')->where('is_active',1)->order_by('id','desc')->limit(4,0)->get();
    }

    function tampil_link()
    {
        return $this->db->select('*')->from('tb_link')->where('is_active',1)->order_by('id','desc')->get();
    }

    function tampil_alumni()
    {
        return $this->db->select('*')->from('tb_isialumni')->where('status',1)->where('kesan != ','')->where('gambar != ','')->order_by('id','desc')->limit(6,0)->get();
    }

    function tampil_download()
    {
        return $this->db->select('*')->from('tb_download')->where('is_active',1)->order_by('id','desc')->limit(5,0)->get();
    }

    function tampil_ekstrakurikuler()
    {
        return $this->db->select('*')->from('tb_ekstrakurikuler')->order_by('id','desc')->limit(5,0)->get();
    }

    function berita_terpopuler($slug = null)
    {
        return $this->db->select('id,nama,gambar,dibaca,is_active,hari,tgl,slug')->from('tb_berita')->where('is_active',1)->where('slug !=',$slug)->order_by('dibaca','desc')->order_by('id','desc')->limit(3,0)->get();
    }

    function tampil_album()
    {
        return $this->db->select('*')->from('tb_album')->where('is_active',1)->order_by('tgl','desc')->limit(2,0)->get();
    }

    function tampil_video()
    {
        return $this->db->select('*')->from('tb_video')->order_by('uploaded_on','desc')->limit(2,0)->get();
    }

    function kunjungan()
    {
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time(); 
        $cekk = $this->db->query("SELECT * FROM tb_statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0)
        {
          $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
          $this->db->insert('tb_statistik',$datadb);
        }else
        {
          $hitss = $rowh['hits'] + 1;
          $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
          $array = array('ip' => $ip, 'tanggal' => $tanggal);
          $this->db->where($array);
          $this->db->update('tb_statistik',$datadb);
        }
    }
        
    function grafik_kunjungan()
    {
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM tb_statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }
    
    function pengunjung()
    {
        return $this->db->query("SELECT COUNT(ip) as total FROM tb_statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY ip");
    }
    
    function totalpengunjung()
    {
        return $this->db->query("SELECT COUNT(hits) as total FROM tb_statistik");
    }
    
    function hits()
    {
        return $this->db->query("SELECT SUM(hits) as total FROM tb_statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY tanggal");
    }
    
    function totalhits()
    {
        return $this->db->query("SELECT SUM(hits) as total FROM tb_statistik");
    }
    
    function pengunjungonline()
    {
        $bataswaktu = time() - 300;
        return $this->db->query("SELECT * FROM tb_statistik WHERE online > '$bataswaktu'");
    }

}
