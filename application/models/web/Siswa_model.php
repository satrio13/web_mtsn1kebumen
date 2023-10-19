<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_siswa()
    {
        return $this->db->select('s.*,t.tahun')->from('tb_siswa s')->join('tb_tahun t','s.id_tahun=t.id_tahun')->order_by('t.tahun','desc')->get();
    }

}