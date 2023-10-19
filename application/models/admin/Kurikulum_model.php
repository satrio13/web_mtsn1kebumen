<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kurikulum_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function tampil_kurikulum()
    {
        return $this->db->select('*')->from('tb_kurikulum')->order_by('id_kurikulum','desc')->get();
    }

    function tambah_kurikulum()
	{
        $this->db->trans_start();
            $data_insert = [
                'mapel' => strip_tags($this->input->post('mapel',TRUE)),
                'kelompok' =>  strip_tags($this->input->post('kelompok',TRUE)),
                'alokasi' =>  strip_tags($this->input->post('alokasi',TRUE)),
                'no_urut' =>  strip_tags($this->input->post('no_urut',TRUE)),
                'is_active' => strip_tags($this->input->post('is_active',TRUE))
            ];
            $this->db->insert('tb_kurikulum',$data_insert);
            
            $data_insert_kkm = [
                'id_kurikulum' => $this->db->insert_id()
            ];
            $this->db->insert('tb_kkm',$data_insert_kkm);

        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE)
        { 
            $this->session->set_flashdata('msg-kurikulum', 'DATA BERHASIL DITAMBAHKAN');
            redirect('backend/kurikulum');
        }else
        {
            $this->session->set_flashdata('msg-gagal-kurikulum', 'DATA GAGAL DITAMBAHKAN!');
        }
    }

    function cek_kurikulum($id_kurikulum)
    {
        return $this->db->select('id_kurikulum')->from('tb_kurikulum')->where('id_kurikulum',$id_kurikulum)->get()->row();
    }

    function edit_kurikulum($id_kurikulum)
	{ 	
        $data_update = [
            'mapel' => strip_tags($this->input->post('mapel',TRUE)),
            'kelompok' =>  strip_tags($this->input->post('kelompok',TRUE)),
            'alokasi' =>  strip_tags($this->input->post('alokasi',TRUE)),
            'no_urut' =>  strip_tags($this->input->post('no_urut',TRUE)),
            'is_active' => strip_tags($this->input->post('is_active',TRUE))
        ];

        $this->db->update('tb_kurikulum',$data_update, ['id_kurikulum'=>$id_kurikulum]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-kurikulum', 'DATA BERHASIL DIUPDATE');
            redirect('backend/kurikulum');
        }else
        {
            $this->session->set_flashdata('msg-gagal-kurikulum', 'DATA GAGAL DIUPDATE!');
        }
    }

    function hapus_kurikulum($id_kurikulum)
	{   
        $jml_un = $this->db->select('id_kurikulum')->from('tb_rekap_un')->where('id_kurikulum',$id_kurikulum)->get()->num_rows();
        $jml_us = $this->db->select('id_kurikulum')->from('tb_rekap_us')->where('id_kurikulum',$id_kurikulum)->get()->num_rows();
        if($jml_un > 0 OR $jml_us > 0)
        {
			$this->session->set_flashdata('msg-gagal-kurikulum', 'DATA GAGAL DIHAPUS!');
        }else
        {
			$this->db->trans_start();
			$this->db->delete('tb_kurikulum', array('id_kurikulum'=>$id_kurikulum));
			$this->db->delete('tb_kkm', array('id_kurikulum'=>$id_kurikulum));
			$this->db->trans_complete();
            if($this->db->trans_status() === TRUE)
            { 
				$this->session->set_flashdata('msg-kurikulum', 'DATA BERHASIL DIHAPUS');
            }else
            {
				$this->session->set_flashdata('msg-gagal-kurikulum', 'DATA GAGAL DIHAPUS!');
			}
		}
		redirect('backend/kurikulum');
    }

}