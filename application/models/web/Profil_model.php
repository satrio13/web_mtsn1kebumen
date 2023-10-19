<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_profil()
    {
        return $this->db->get_where('tb_profil',['id'=>1])->row();
    }

    function tampil_sejarah()
    {
        return $this->db->get_where('tb_sejarah',['id'=>1])->row();
    }

    function tampil_visi_misi()
    {
        return $this->db->get_where('tb_visimisi',['id'=>1])->row();
    }

    function tampil_struktur_organisasi()
    {
        return $this->db->get_where('tb_struktur_organisasi',['id'=>1])->row();
    }

    function tampil_ekstrakurikuler()
    {
        return $this->db->select('id,nama_ekstrakurikuler,slug')->from('tb_ekstrakurikuler')->order_by('id','desc')->get();
    }

    function tampil_sarpras()
    {
        return $this->db->get_where('tb_sarpras',['id'=>1])->row();
    }

    function cek_ekstrakurikuler($slug)
    {
        return $this->db->select('slug')->from('tb_ekstrakurikuler')->where('slug',$slug)->get()->row();
    }
    
}