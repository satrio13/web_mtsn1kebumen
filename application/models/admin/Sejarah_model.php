<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sejarah_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_sejarah()
    {
        return $this->db->select('*')->from('tb_sejarah')->where('id',1)->get()->row();
    }

    function edit_sejarah()
	{
        $data = [
            'isi' => $this->input->post('isi',TRUE)			
        ];
        $this->db->update('tb_sejarah', $data, ['id'=>1]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-sejarah', 'SEJARAH BERHASIL DIUPDATE');
            redirect('backend/sejarah');
        }else
        {
            $this->session->set_flashdata('msg-gagal-sejarah', 'SEJARAH GAGAL DIUPDATE!');
        }
    }
    
}