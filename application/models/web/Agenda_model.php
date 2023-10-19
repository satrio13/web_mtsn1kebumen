<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda_model extends CI_Model {
 
    function __construct(){
        parent::__construct();
    }

    function tampil_agenda()
    {
        return $this->db->select('*')->from('tb_agenda')->order_by('id','desc')->get();
    }

    function tampil_agenda_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_agenda')->order_by('id','desc')->limit($limit,$start)->get();
    }

    function tampil_agenda_cari($cari)
    {
        return $this->db->select('*')->from('tb_agenda')->like('nama_agenda',$this->db->escape_str($cari))->order_by('id','desc')->get();
    }

    function tampil_agenda_pagination_cari($limit, $start, $cari)
    {
        return $this->db->select('*')->from('tb_agenda')->like('nama_agenda',$this->db->escape_str($cari))->order_by('id','desc')->limit($limit,$start)->get();
    }

    function cek_agenda($slug)
    {
        return $this->db->select('slug')->from('tb_agenda')->where('slug',$slug)->get()->row();
    }

}