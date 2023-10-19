<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_program()
    {
        return $this->db->select('*')->from('tb_program')->order_by('id','desc')->get();
    }

    function cek_program($id)
    {
        return $this->db->select('id')->from('tb_program')->where('id',$id)->get()->row();
    }

    function edit_program($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_program')->where('id',$id)->get()->row();
        $target = "assets/img/program/$get->gambar";

        $config['upload_path'] = 'assets/img/program/';
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
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'gambar'=>$gbr['file_name']
                ];
                $this->db->update('tb_program',$data, ['id'=>$id]);
                $this->session->set_flashdata('msg-program', 'DATA BERHASIL DIUPDATE');
                redirect('backend/program');
            }else
            {
                $this->session->set_flashdata('msg-gagal-program', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'keterangan' => $this->input->post('keterangan',TRUE)
            ];
            $this->db->update('tb_program',$data, ['id'=>$id]);
            $this->session->set_flashdata('msg-program', 'PENGUMUMAN BERHASIL DIUPDATE');
            redirect('backend/program');
        }
    }
    
}