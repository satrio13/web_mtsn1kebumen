<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prestasi_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function tampil_prestasi_siswa()
    {
        return $this->db->select('p.*,t.tahun')->from('tb_prestasi_siswa p')->join('tb_tahun t', 'p.id_tahun=t.id_tahun')->order_by('id','desc')->get();
    }
    
    function tampil_prestasi_guru()
    {
        return $this->db->select('p.*,t.tahun')->from('tb_prestasi_guru p')->join('tb_tahun t', 'p.id_tahun=t.id_tahun')->order_by('id','desc')->get();
    }

    function tampil_prestasi_sekolah()
    {
        return $this->db->select('p.*,t.tahun')->from('tb_prestasi_sekolah p')->join('tb_tahun t', 'p.id_tahun=t.id_tahun')->order_by('id','desc')->get();
    }
    
}