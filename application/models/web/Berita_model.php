<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita_model extends CI_Model {
 
    function __construct(){
        parent::__construct();
    }

    function tampil_berita()
    {
        return $this->db->select('*')->from('tb_berita')->where('is_active',1)->order_by('id','desc')->get();
    }

    function tampil_berita_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_berita')->where('is_active',1)->order_by('id','desc')->limit($limit,$start)->get();
    }

    function tampil_berita_cari($cari)
    {
        return $this->db->select('*')->from('tb_berita')->where('is_active',1)->like('nama',$this->db->escape_str($cari))->order_by('id','desc')->get();
    }

    function tampil_berita_pagination_cari($limit, $start, $cari)
    {
        return $this->db->select('*')->from('tb_berita')->where('is_active',1)->like('nama',$this->db->escape_str($cari))->order_by('id','desc')->limit($limit,$start)->get();
    }

    function cek_berita($slug)
    {
        return $this->db->select('slug')->from('tb_berita')->where('slug',$slug)->get()->row();
    }
 
}