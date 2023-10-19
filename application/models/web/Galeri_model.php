<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Galeri_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function tampil_album()
    {
        return $this->db->select('*')->from('tb_album')->where('is_active',1)->order_by('tgl','desc')->get();
    }

    function tampil_album_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_album')->where('is_active',1)->order_by('tgl','desc')->limit($limit,$start)->get();
    }

    function cek_album($slug)
    {
        return $this->db->select('slug')->from('tb_album')->where('slug',$slug)->get()->row();
    }

    function tampil_foto($slug)
    {
        return $this->db->select('f.id_foto,f.id_album,f.foto,f.uploaded_on,a.album,a.tgl,a.is_active,a.slug')->from('tb_foto f')->join('tb_album a','f.id_album=a.id_album')->where('a.is_active',1)->where('a.slug',$slug)->order_by('f.uploaded_on','desc')->get();
    }

    function tampil_video()
    {
        return $this->db->select('*')->from('tb_video')->order_by('uploaded_on','desc')->get();
    }

    function tampil_video_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_video')->order_by('uploaded_on','desc')->limit($limit,$start)->get();
    }

}