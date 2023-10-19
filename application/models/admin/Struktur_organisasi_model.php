<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Struktur_organisasi_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_struktur_organisasi()
    {
        return $this->db->select('*')->from('tb_struktur_organisasi')->where('id',1)->get()->row();
    }

    function edit_struktur_organisasi()
	{
        $get = $this->db->select('id,isi')->from('tb_struktur_organisasi')->where('id',1)->get()->row();
        $target = "assets/img/struktur/$get->isi";				
        $config['upload_path'] = 'assets/img/struktur/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['struktur']['name']))
        {
            if($this->upload->do_upload('struktur'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'isi' => $gbr['file_name']
                ];
                $this->db->update('tb_struktur_organisasi', $data, ['id'=>1]);
                $this->session->set_flashdata('msg-struktur', 'Struktur Organisasi berhasil diupdate');
                redirect('backend/struktur-organisasi');
            }else
            {
                $this->session->set_flashdata('msg-gagal-struktur', 'Gambar gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-struktur', 'Anda belum memilih file yang akan diupload!');
        }
    }
    
}