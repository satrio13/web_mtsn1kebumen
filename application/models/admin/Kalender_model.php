<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kalender_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function edit_kalender()
    {
        $get = $this->db->select('*')->from('tb_kalender')->where('id',1)->get()->row();
        $target = "assets/file/$get->kalender";				
        $config['upload_path'] = 'assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        //$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '5120'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['file']['name']))
        {
            if($this->upload->do_upload('file'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data_update = [
                    'kalender' => $gbr['file_name']
                ];
                $this->db->update('tb_kalender',$data_update, ['id'=>1]);
                $this->session->set_flashdata('msg-kalender', 'File berhasil diupdate');
                redirect('backend/kalender');
            }else
            {
                $this->session->set_flashdata('msg-gagal-kalender', 'File gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-kalender', 'Anda belum memilih file yang akan diupload!');
        }
    }

}