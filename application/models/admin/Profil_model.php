<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_profil()
    {
        return $this->db->select('*')->from('tb_profil')->where('id',1)->get()->row();
    }

    function edit_profil_web()
	{
        $data = [
            'nama_web' => strip_tags($this->input->post('nama_web',TRUE)),
            'jenjang' => strip_tags($this->input->post('jenjang',TRUE)),
            'meta_description' => strip_tags($this->input->post('meta_description',TRUE)),
            'meta_keyword' => strip_tags($this->input->post('meta_keyword',TRUE)),
            'profil' => strip_tags($this->input->post('profil',TRUE)),
            'alamat' => strip_tags($this->input->post('alamat',TRUE)),
            'email' => strip_tags($this->input->post('email',TRUE)),
            'telp' => strip_tags($this->input->post('telp',TRUE)),
            'fax' => strip_tags($this->input->post('fax',TRUE)),
            'whatsapp' => strip_tags($this->input->post('whatsapp',TRUE)),
            'akreditasi' => strip_tags($this->input->post('akreditasi',TRUE)),
            'kurikulum' => strip_tags($this->input->post('kurikulum',TRUE)),
            'nama_kepsek' => strip_tags($this->input->post('nama_kepsek',TRUE)),
            'nama_operator' => strip_tags($this->input->post('nama_operator',TRUE)),
            'instagram' => strip_tags($this->input->post('instagram',TRUE)),
            'facebook' => strip_tags($this->input->post('facebook',TRUE)),
            'twitter' => strip_tags($this->input->post('twitter',TRUE)),
            'youtube' => strip_tags($this->input->post('youtube',TRUE))					
        ];
        $this->db->update('tb_profil', $data, ['id'=>1]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-profil', 'PROFIL BERHASIL DIUPDATE');
            redirect('backend/profil-web');
        }else
        {
            $this->session->set_flashdata('msg-gagal-profil', 'PROFIL GAGAL DIUPDATE!');
        }
    }

    function logo_web()
	{
        $get = $this->db->select('id,logo_web')->from('tb_profil')->where('id',1)->get()->row();
        $target = "assets/img/logo/$get->logo_web";
        $config['upload_path'] = 'assets/img/logo/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['logo_web']['name']))
        {
            if($this->upload->do_upload('logo_web'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'logo_web' => $gbr['file_name']
                ];
                $this->db->update('tb_profil', $data, ['id'=>1]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-profil', 'LOGO WEBSITE BERHASIL DIUPDATE');
                    redirect('backend/profil-web');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-profil', 'LOGO WEBSITE GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-logo', 'Logo Web gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-logo', 'Anda belum memilih file yang akan diupload!');
        }
    }

    function logo_admin()
	{
        $get = $this->db->select('id,logo_admin')->from('tb_profil')->where('id',1)->get()->row();
        $target = "assets/img/logo/$get->logo_admin";
        $config['upload_path'] = 'assets/img/logo/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['logo_admin']['name']))
        {
            if($this->upload->do_upload('logo_admin'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'logo_admin' => $gbr['file_name']
                ];
                $this->db->update('tb_profil', $data, ['id'=>1]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-profil', 'LOGO LOGIN ADMIN BERHASIL DIUPDATE');
                    redirect('backend/profil-web');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-profil', 'LOGO LOGIN ADMIN GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-logo-admin', 'Logo Login Admin gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-logo-admin', 'Anda belum memilih file yang akan diupload!');
        }
    }

    function favicon()
	{
        $get = $this->db->select('id,favicon')->from('tb_profil')->where('id',1)->get()->row();
        $target = "assets/img/logo/$get->favicon";
        $config['upload_path'] = 'assets/img/logo/';
        $config['allowed_types'] = 'ico';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['favicon']['name']))
        {
            if($this->upload->do_upload('favicon'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'favicon' => $gbr['file_name']
                ];
                $this->db->update('tb_profil', $data, ['id'=>1]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-profil', 'FAVICON WEBSITE BERHASIL DIUPDATE');
                    redirect('backend/profil-web');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-profil', 'FAVICON WEBSITE GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-favicon', 'Favicon Web gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-favicon', 'Anda belum memilih file yang akan diupload!');
        }
    }

    function gambar_profil()
	{
        $get = $this->db->select('id,gambar')->from('tb_profil')->where('id',1)->get()->row();
        $target = "assets/img/profil/$get->gambar";
        $config['upload_path'] = 'assets/img/profil/';
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
                    'gambar' => $gbr['file_name']
                ];
                $this->db->update('tb_profil', $data, ['id'=>1]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-gambar', 'GAMBAR PROFIL BERHASIL DIUPDATE');
                    redirect('backend/profil-web');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-gambar', 'GAMBAR PROFIL GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-gambar', 'Gambar Profil gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-gambar', 'Anda belum memilih file yang akan diupload!');
        }
    }

    function file()
	{
        $get = $this->db->select('id,file')->from('tb_profil')->where('id',1)->get()->row();
        $target = "assets/file/$get->file";
        $config['upload_path'] = 'assets/file/';
        $config['allowed_types'] = 'pdf';
        //$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '5120'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['file']['name']))
        {
            if($this->upload->do_upload('file'))
            { 
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'file' => $gbr['file_name']
                ];
                $this->db->update('tb_profil', $data, ['id'=>1]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-file', 'FILE BERHASIL DIUPDATE');
                    redirect('backend/profil-web');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-file', 'FILE GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-file', 'File gagal diupload! periksa kembali format dan ukuran file anda!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-file', 'Anda belum memilih file yang akan diupload!');
        }
    }

}