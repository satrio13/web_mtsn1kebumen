<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengaduan_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tambah_pengaduan()
    {
        $secutity_code = $this->input->post('secutity_code');
        $mycaptcha = $this->session->userdata('mycaptcha');
        if($secutity_code == $mycaptcha)
        {       
            $data = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'status' => strip_tags($this->input->post('status',TRUE)),
                'isi' => strip_tags($this->input->post('isi',TRUE))
            ];

            $this->db->insert('tb_pengaduan', $data);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-pengaduan', 'TERIMAKASIH, DATA BERHASIL DIKIRIM');
                redirect('pengaduan');
            }else
            {
                $this->session->set_flashdata('msg-gagal-pengaduan', 'DATA GAGAL DIKIRIM, SILAHKAN COBA LAGI !');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-pengaduan', 'Captcha salah');
        }
    }

}