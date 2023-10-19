<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tahun_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_tahun()
    {
        return $this->db->select('*')->from('tb_tahun')->order_by('id_tahun','desc')->get();
    }

    function tambah_tahun_pelajaran()
	{
        $data = [
            'tahun' => $this->input->post('tahun',TRUE)
        ];
        $this->db->insert('tb_tahun',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-tahun', 'DATA BERHASIL DITAMBAHKAN');
            redirect('backend/tahun-pelajaran');
        }else
        {
            $this->session->set_flashdata('msg-gagal-tahun', 'DATA GAGAL DITAMBAHKAN!');
        }
    }

    function cek_tahun($id_tahun)
    {
        return $this->db->select('id_tahun')->from('tb_tahun')->where('id_tahun',$id_tahun)->get()->row();
    }

    function edit_tahun_pelajaran($id_tahun)
	{
        $data = [
            'tahun' => $this->input->post('tahun',TRUE)
        ];
        $this->db->update('tb_tahun',$data,['id_tahun'=>$id_tahun]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-tahun', 'DATA BERHASIL DIUPDATE');
            redirect('backend/tahun-pelajaran');
        }else
        {
            $this->session->set_flashdata('msg-gagal-tahun', 'DATA GAGAL DIUPDATE!');
        }
    }

    function hapus_tahun_pelajaran($id_tahun)
	{
        $jml_un = $this->db->select('id_tahun')->from('tb_rekap_un')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_us = $this->db->select('id_tahun')->from('tb_rekap_us')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_s = $this->db->select('id_tahun')->from('tb_siswa')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_p_siswa = $this->db->select('id_tahun')->from('tb_prestasi_siswa')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_p_guru = $this->db->select('id_tahun')->from('tb_prestasi_guru')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_p_sekolah = $this->db->select('id_tahun')->from('tb_prestasi_sekolah')->where('id_tahun',$id_tahun)->get()->num_rows();
        $jml_a = $this->db->select('id_tahun')->from('tb_alumni')->where('id_tahun',$id_tahun)->get()->num_rows();

        if($jml_un > 0 OR $jml_us > 0 OR $jml_s > 0 OR $jml_p_siswa > 0 OR $jml_p_guru > 0 OR $jml_p_sekolah > 0 OR $jml_a > 0)
        {
			$this->session->set_flashdata('msg-gagal-tahun', 'DATA GAGAL DIHAPUS!');
        }else
        {
			$this->db->delete('tb_tahun', ['id_tahun'=>$id_tahun]);
            if($this->db->affected_rows() > 0)
            { 
				$this->session->set_flashdata('msg-tahun', 'DATA BERHASIL DIHAPUS');
            }else
            {
				$this->session->set_flashdata('msg-gagal-tahun', 'DATA GAGAL DIHAPUS!');
			}
		}
		redirect('backend/tahun-pelajaran');
    }

}