<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ekstakurikuler_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_ekstrakurikuler()
    {
        return $this->db->select('*')->from('tb_ekstrakurikuler')->order_by('id','desc')->get();
    }

    function tambah_ekstrakurikuler()
	{ 
        $config['upload_path'] = 'assets/img/ekstrakurikuler/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);
        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                $gbr = $this->upload->data();
                $data = [
                    'nama_ekstrakurikuler' => strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'gambar'=>$gbr['file_name'],
                    'slug'=> slug(strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)))
                ];
                $this->db->insert('tb_ekstrakurikuler',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-ekstrakurikuler', 'DATA BERHASIL DITAMBAHKAN');
                    redirect('backend/ekstrakurikuler');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'DATA GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama_ekstrakurikuler' => strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'slug'=> slug(strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)))
            ];
            $this->db->insert('tb_ekstrakurikuler',$data);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-ekstrakurikuler', 'DATA BERHASIL DITAMBAHKAN');
                redirect('backend/ekstrakurikuler');
            }else
            {
                $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'DATA GAGAL DITAMBAHKAN!');
            }
        }
    }

    function cek_ekstrakurikuler($id)
    {
        return $this->db->select('id')->from('tb_ekstrakurikuler')->where('id',$id)->get()->row();
    }

    function edit_ekstrakurikuler($id)
	{ 	
        $get = $this->db->select('id,gambar')->from('tb_ekstrakurikuler')->where('id',$id)->get()->row();
        $target = "assets/img/ekstrakurikuler/$get->gambar";

        $config['upload_path'] = 'assets/img/ekstrakurikuler/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'nama_ekstrakurikuler' => strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'gambar'=>$gbr['file_name'],
                    'slug'=> slug(strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)))
                ];
                $this->db->update('tb_ekstrakurikuler',$data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-ekstrakurikuler', 'DATA BERHASIL DIUPDATE');
                    redirect('backend/ekstrakurikuler');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'DATA GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama_ekstrakurikuler' => strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'slug'=> slug(strip_tags($this->input->post('nama_ekstrakurikuler',TRUE)))
            ];
            $this->db->update('tb_ekstrakurikuler',$data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-ekstrakurikuler', 'DATA BERHASIL DIUPDATE');
                redirect('backend/ekstrakurikuler');
            }else
            {
                $this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'DATA GAGAL DIUPDATE!');
            }
        }
    }

    function hapus_ekstrakurikuler($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_ekstrakurikuler')->where('id',$id)->get()->row();
        $target = "assets/img/ekstrakurikuler/$get->gambar";
        unlink($target);
		$this->db->delete('tb_ekstrakurikuler', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-ekstrakurikuler', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-ekstrakurikuler', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/ekstrakurikuler');
    }
    
}