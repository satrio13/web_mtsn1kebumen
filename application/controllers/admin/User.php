<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
        
		$this->load->model('admin/user_model');
    } 
    
    function index()
	{	
        if($this->session->userdata('level') == 'superadmin')
        {
			$data['data'] = $this->user_model->tampil_user();
			$data['title'] = 'Users';
			//layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/user/users', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/user/script');
        }else
        {
			show_404();
		}
    }

    function tambah_user()
	{ 	
        if($this->session->userdata('level') == 'superadmin')
        {
			if($this->input->post('submit', TRUE) == 'Submit')
			{ 
				$this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
				$this->form_validation->set_rules('nama', 'Nama', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[30]|trim|is_unique[tb_user.username]', [
				'is_unique' => 'Username sudah digunakan!'
				]);
				$this->form_validation->set_rules('password1', 'Password', 'required|alpha_numeric|trim|min_length[5]|max_length[30]');
				$this->form_validation->set_rules('password2', 'Ulang Password', 'required|alpha_numeric|trim|matches[password1]');
				$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[tb_user.email]', [
				'is_unique' => 'Email sudah terdaftar!'
				]);
				$this->form_validation->set_rules('is_active', 'Status', 'required');
				if($this->form_validation->run() == TRUE)
				{ 
					$this->user_model->tambah_user();
				}
			}
			$data['title'] = 'Tambah User';
			//layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/user/form_tambah_user', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/user/script');
        }else
        {
			show_404();
		}
    }
    
    function edit_user($id)
	{ 	
        if($this->session->userdata('level') == 'superadmin')
        {
            $cek = $this->user_model->cek_user($id); 
            if(!$cek)
            { 
                show_404(); 
            }else
            {
                if($this->input->post('submit', TRUE)=='Submit')
                { 
                    $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
                    $this->form_validation->set_rules('nama', 'Nama', 'required');
                    $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[30]|trim|callback_cek_username['.$id.']');
                    $this->form_validation->set_rules('password', 'Password', 'alpha_numeric|trim|min_length[5]|max_length[30]');
                    $this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_cek_email['.$id.']');
                    $this->form_validation->set_rules('is_active', 'Status', 'required');
                    if($this->form_validation->run() == TRUE)
                    { 	
                        $this->user_model->edit_user($id);
                    }
                }
            }
            $data['title'] = 'Edit User';
            $data['data'] = $this->db->get_where('tb_user',['id_user'=>$id])->row();
			//layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/user/form_edit_user', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/user/script');
        }else
        {
			show_404();
		}
    }

    function edit_profil()
	{ 	
		$id = $this->session->userdata('id_user');
        $cek = $this->user_model->cek_user($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            if($this->input->post('submit', TRUE) == 'Submit')
            { 
                $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
                $this->form_validation->set_rules('nama', 'Nama', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[8]|trim|callback_cek_username['.$id.']');
                $this->form_validation->set_rules('email','Email','required|trim|valid_email|callback_cek_email['.$id.']');
                if($this->form_validation->run() == TRUE)
                { 	
                    $this->user_model->edit_profil($id);
                }
            }
            $data['title'] = 'Edit Profil';
            $data['data'] = $this->db->get_where('tb_user',['id_user'=>$id])->row();
            //layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/user/form_edit_profil', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/user/script');
        }
    }
    
    function ganti_password()
	{ 
		$id_user = $this->session->userdata('id_user');
		$get = $this->db->get_where('tb_user', array('id_user' => $id_user))->row();
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|trim|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('password1', 'Password Baru', 'required|alpha_numeric|trim|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('password2', 'Ketik Ulang Password Baru', 'required|alpha_numeric|trim|matches[password1]');
			$this->form_validation->set_rules('password3', 'Password Lama', 'required');
			if($this->form_validation->run() == TRUE)
			{
                if(!password_verify($this->input->post('password3',TRUE), $get->password))
                {
					$this->session->set_flashdata('msg-gagal-ganti-password', 'Password lama yang anda inputkan salah!');
                }elseif(password_verify($this->input->post('password1',TRUE), $get->password))
                {
					$this->session->set_flashdata('msg-gagal-ganti-password', 'Password baru yang anda inputkan sama dengan password lama!');
                }else
                {
					$this->user_model->ganti_password($id_user);
				}
			}
		}
		$data['title'] = 'Ganti Password';
		$data['username'] = $get->username;
		//layout
        $this->load->view('admin/template/head');
        $this->load->view('admin/template/topbar');
        $this->load->view('admin/template/nav');
        $this->load->view('admin/user/gantipass', $data);
        $this->load->view('admin/template/js');
        $this->load->view('admin/user/script');
    }

    function cek_username($username = '', $id_user = '')
    {
		$cek = $this->db->select('username')->from('tb_user')->where('username',$username)->where('id_user != ',$id_user)->get()->num_rows();
		if($cek)
		{
			$this->form_validation->set_message('cek_username', 'Username sudah digunakan');
			return FALSE;
		}else
		{
			return TRUE;
		}
    }

	function cek_email($email = '', $id_user = '')
    {
		$cek = $this->db->select('email')->from('tb_user')->where('email',$email)->where('id_user != ',$id_user)->get()->num_rows();
		if($cek)
		{
			$this->form_validation->set_message('cek_email', 'Email sudah digunakan');
			return FALSE;
		}else
		{
			return TRUE;
		}
	}

    function hapus_user($id)
	{ 	
        if($this->session->userdata('level') == 'superadmin')
        {
            $cek = $this->user_model->cek_user($id); 
            if(!$cek)
            { 
                show_404(); 
            }else
            {
                $this->user_model->hapus_user($id);
            }
        }else
        {
            show_404();
        }
    }

}