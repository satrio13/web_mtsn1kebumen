<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pendidikan_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_kurikulum_a()
    {
        return $this->db->select('*')->from('tb_kurikulum')->where('is_active',1)->where('kelompok','A')->order_by('no_urut','asc')->get();
    }

    function tampil_kurikulum_b()
    {
        return $this->db->select('*')->from('tb_kurikulum')->where('is_active',1)->where('kelompok','B')->order_by('no_urut','asc')->get();
    }

    function tampil_kurikulum_c()
    {
        return $this->db->select('*')->from('tb_kurikulum')->where('is_active',1)->where('kelompok','C')->order_by('no_urut','asc')->get();
    }

    function kalender()
    {
        return $this->db->select('*')->from('tb_kalender')->where('id',1)->get()->row();
    }

    function cari_rekap_us()
    {
        return $this->db->select('u.id_us,u.id_kurikulum,u.tertinggi,u.terendah,u.rata,u.id_tahun,m.mapel,m.is_active,t.tahun')->from('tb_rekap_us u')->join('tb_kurikulum m','u.id_kurikulum=m.id_kurikulum')->join('tb_tahun t','u.id_tahun=t.id_tahun')->where('u.id_tahun',$this->input->post('id_tahun',TRUE))->order_by('m.mapel','asc')->get();
    }

}