<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sarpras_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_sarpras()
    {
        return $this->db->select('*')->from('tb_sarpras')->where('id',1)->get()->row();
    }

    function edit_sarpras()
	{
        $data = [
            'isi' => $this->input->post('isi',TRUE)			
        ];
        $this->db->update('tb_sarpras', $data, ['id'=>1]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-sarpras', 'SARANA DAN PRASARANA BERHASIL DIUPDATE');
            redirect('backend/sarpras');
        }else
        {
            $this->session->set_flashdata('msg-gagal-sarpras', 'SARANA DAN PRASARANA GAGAL DIUPDATE!');
        }
    }

}