<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function tampil_user()
    {
        return $this->db->select('*')->from('tb_user')->order_by('id_user','desc')->get();
    }

    function tambah_user()
    {
        $data_insert = [
            'nama' => strip_tags($this->input->post('nama',TRUE)),
            'username' => strip_tags($this->input->post('username',TRUE)),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'email' => strip_tags($this->input->post('email',TRUE)),
            'level' => 'admin',
            'is_active' => strip_tags($this->input->post('is_active',TRUE))
        ];

        $this->db->insert('tb_user',$data_insert);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-user', 'USER BERHASIL DITAMBAHKAN');
            redirect('backend/users');
        }else
        {
            $this->session->set_flashdata('msg-gagal-user', 'USER GAGAL DITAMBAHKAN!');
        }
    }

    function cek_user($id)
    {
        return $this->db->select('id_user')->from('tb_user')->where('id_user',$id)->get()->row();
    }

    function edit_user($id)
    {
        $password = strip_tags($this->input->post('password',TRUE));
        if(!empty($password))
        {
            $data_update = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'username' => strip_tags($this->input->post('username',TRUE)),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => strip_tags($this->input->post('email',TRUE)),
                'is_active' => strip_tags($this->input->post('is_active',TRUE))
            ];
        }else
        {
            $data_update = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'username' => strip_tags($this->input->post('username',TRUE)),
                'email' => strip_tags($this->input->post('email',TRUE)),
                'is_active' => strip_tags($this->input->post('is_active',TRUE))
            ];
        }
        $this->db->update('tb_user',$data_update, ['id_user'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-user', 'DATA BERHASIL DIUPDATE');
            redirect('backend/users');
        }else
        {
            $this->session->set_flashdata('msg-gagal-user', 'DATA GAGAL DIUPDATE!');
        }
    }

    function edit_profil($id)
    {
        $data_update = [
            'nama' => strip_tags($this->input->post('nama',TRUE)),
            'username' => strip_tags($this->input->post('username',TRUE)),
            'email' => strip_tags($this->input->post('email',TRUE))
        ];

        $this->db->update('tb_user',$data_update, ['id_user'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-user', 'DATA BERHASIL DIUPDATE');
        }else
        {
            $this->session->set_flashdata('msg-gagal-user', 'DATA GAGAL DIUPDATE!');
        }
    }

    function ganti_password($id_user)
    {
        $data = [
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
        ];
        $this->db->update('tb_user',$data,['id_user'=>$id_user]);
        if($this->db->affected_rows() > 0)
        {
            echo '<script type="text/javascript">alert("Password berhasil dirubah");window.location.replace("'.base_url().'auth/logout")</script>';
        }else
        {
            $this->session->set_flashdata('msg-gagal-user', 'PASSWORD GAGAL DIGANTI!');
        }
    }

    function hapus_user($id)
	{ 
        $cek_pengumuman = $this->db->select('id_user')->from('tb_pengumuman')->where('id_user',$id)->get()->num_rows();
        $cek_berita = $this->db->select('id_user')->from('tb_berita')->where('id_user',$id)->get()->num_rows();
        $cek_download = $this->db->select('id_user')->from('tb_download')->where('id_user',$id)->get()->num_rows();
        if($cek_pengumuman > 0 OR $cek_berita > 0 OR $cek_download > 0)
        {
            $this->session->set_flashdata('msg-gagal-user', 'DATA GAGAL DIHAPUS!');
        }else
        {
            $this->db->delete('tb_user', array('id_user'=>$id));
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-user', 'DATA BERHASIL DIHAPUS');
            }else
            {
                $this->session->set_flashdata('msg-gagal-user', 'DATA GAGAL DIHAPUS!');
            }
        }
        redirect('backend/users');
    }

}