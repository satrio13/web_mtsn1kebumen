<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Link_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function tampil_link()
    {
        return $this->db->select('*')->from('tb_link')->order_by('id','desc')->get();
    }

    function tambah_link()
	{
        $data = [
            'nama' => strip_tags($this->input->post('nama',TRUE)),
            'link' => $this->input->post('link',TRUE),
            'is_active' => strip_tags($this->input->post('is_active',TRUE))
        ];

        $this->db->insert('tb_link',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-link', 'LINK BERHASIL DITAMBAHKAN');
            redirect('backend/link-terkait');
        }else
        {
            $this->session->set_flashdata('msg-gagal-link', 'LINK GAGAL DITAMBAHKAN!');
        }
    }

    function cek_link($id)
    {
        return $this->db->select('id')->from('tb_link')->where('id',$id)->get()->row();
    }

    function edit_link($id)
	{
        $data = [
            'nama' => strip_tags($this->input->post('nama',TRUE)),
            'link' => $this->input->post('link',TRUE),
            'is_active' => strip_tags($this->input->post('is_active',TRUE))
        ];

        $this->db->update('tb_link', $data, ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-link', 'LINK BERHASIL DIUPDATE');
            redirect('backend/link-terkait');
        }else
        {
            $this->session->set_flashdata('msg-gagal-link', 'LINK GAGAL DIUPDATE!');
        }
    }

    function hapus_link($id)
	{
        $this->db->delete('tb_link', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-link', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-link', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/link-terkait');
    }

}