<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengumuman_model extends CI_Model {
 
    function __construct(){
        parent::__construct();
    }

    function tampil_pengumuman()
    {
        return $this->db->select('*')->from('tb_pengumuman')->where('is_active',1)->order_by('id','desc')->get();
    }

    function tampil_pengumuman_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_pengumuman')->where('is_active',1)->order_by('id','desc')->limit($limit,$start)->get();
    }

    function tampil_pengumuman_cari($cari)
    {
        return $this->db->select('*')->from('tb_pengumuman')->where('is_active',1)->like('nama',$this->db->escape_str($cari))->order_by('id','desc')->get();
    }

    function tampil_pengumuman_pagination_cari($limit, $start, $cari)
    {
        return $this->db->select('*')->from('tb_pengumuman')->where('is_active',1)->like('nama',$this->db->escape_str($cari))->order_by('id','desc')->limit($limit,$start)->get();
    }

    function cek_pengumuman($slug)
    {
        return $this->db->select('slug')->from('tb_pengumuman')->where('slug',$slug)->get()->row();
    }
 
}