<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Siswa_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_siswa()
    {
        return $this->db->select('s.*,t.tahun')->from('tb_siswa s')->join('tb_tahun t','s.id_tahun=t.id_tahun')->order_by('s.id_siswa','desc')->get();
    }

    function tambah_siswa()
	{
        $data = [
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
            'jml1pa' => strip_tags($this->input->post('jml1pa',TRUE)),
            'jml1pi' => strip_tags($this->input->post('jml1pi',TRUE)),
            'jml2pa' => strip_tags($this->input->post('jml2pa',TRUE)),
            'jml2pi' => strip_tags($this->input->post('jml2pi',TRUE)),
            'jml3pa' => strip_tags($this->input->post('jml3pa',TRUE)),
            'jml3pi' => strip_tags($this->input->post('jml3pi',TRUE)),
        ];

        $this->db->insert('tb_siswa',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-siswa', 'DATA BERHASIL DITAMBAHKAN');
            redirect('backend/siswa');
        }else
        {
            $this->session->set_flashdata('msg-gagal-siswa', 'DATA GAGAL DITAMBAHKAN!');
        }
    }

    function cek_siswa($id)
    {
        return $this->db->select('id_siswa')->from('tb_siswa')->where('id_siswa',$id)->get()->row();
    }

    function edit_siswa($id)
	{
        $data = [
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
            'jml1pa' => strip_tags($this->input->post('jml1pa',TRUE)),
            'jml1pi' => strip_tags($this->input->post('jml1pi',TRUE)),
            'jml2pa' => strip_tags($this->input->post('jml2pa',TRUE)),
            'jml2pi' => strip_tags($this->input->post('jml2pi',TRUE)),
            'jml3pa' => strip_tags($this->input->post('jml3pa',TRUE)),
            'jml3pi' => strip_tags($this->input->post('jml3pi',TRUE)),
        ];

        $this->db->update('tb_siswa',$data,['id_siswa'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-siswa', 'DATA BERHASIL DIUPDATE');
            redirect('backend/siswa');
        }else
        {
            $this->session->set_flashdata('msg-gagal-siswa', 'DATA GAGAL DIUPDATE!');
        }
    }

    function hapus_siswa($id)
	{
        $this->db->delete('tb_siswa', ['id_siswa'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-siswa', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-siswa', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/siswa');
    }

}