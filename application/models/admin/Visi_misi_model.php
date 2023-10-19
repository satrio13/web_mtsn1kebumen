<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visi_misi_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_visi_misi()
    {
        return $this->db->select('*')->from('tb_visimisi')->where('id',1)->get()->row();
    }

    function edit_visi_misi()
	{
        $data = [
            'isi' => $this->input->post('isi',TRUE)			
        ];
        $this->db->update('tb_visimisi', $data, ['id'=>1]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-visi-misi', 'VISI & MISI BERHASIL DIUPDATE');
            redirect('backend/visi-misi');
        }else
        {
            $this->session->set_flashdata('msg-gagal-visi-misi', 'VISI & MISI GAGAL DIUPDATE!');
        }
    }
    
}