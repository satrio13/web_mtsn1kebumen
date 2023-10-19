<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
        $this->load->model('admin/profil_model');
	} 

	function index()
	{	
        $data['title'] = 'Profil Website';
        $data['data'] = $this->profil_model->tampil_profil();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/profil', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');
    }	

    function edit_profil_web()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
        { 
            $this->_validation();
            if($this->form_validation->run() == TRUE)
            { 
				$this->profil_model->edit_profil_web();
			}
		}
        $data['title'] = 'Edit Profil Website';
        $data['data'] = $this->profil_model->tampil_profil();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_profil', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');
    }

    function logo_web()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
            $this->profil_model->logo_web();
		}
		$data['data'] = $this->db->select('id,logo_web')->from('tb_profil')->where('id',1)->get()->row();
  		$data['title'] = 'Logo Website';
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_logo', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');	
    }

	function logo_admin()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
            $this->profil_model->logo_admin();
		}
		$data['data'] = $this->db->select('id,logo_admin')->from('tb_profil')->where('id',1)->get()->row();
  		$data['title'] = 'Logo Login Admin';
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_logo_admin', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');	
    }

    function favicon()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
            $this->profil_model->favicon();
		}
		$data['data'] = $this->db->select('id,favicon')->from('tb_profil')->where('id',1)->get()->row();
  		$data['title'] = 'Favicon Website';
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_favicon', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');
    }

    function gambar_profil()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
            $this->profil_model->gambar_profil();
		}
		$data['data'] = $this->db->select('id,gambar')->from('tb_profil')->where('id',1)->get()->row();
  		$data['title'] = 'Gambar Profil';
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_gambar', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');
	}
	
	function file()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
            $this->profil_model->file();
		}
		$data['data'] = $this->db->select('id,file')->from('tb_profil')->where('id',1)->get()->row();
  		$data['title'] = 'File';
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/profil/form_file', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/profil/script');	
	}
    
    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
		$this->form_validation->set_rules('nama_web', 'Nama Sekolah', 'required');
		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'required|max_length[300]');
		$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required|max_length[200]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('telp', 'Telp', 'required');
		$this->form_validation->set_rules('fax', 'Fax', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('instagram', 'Instagram', 'valid_url');
		$this->form_validation->set_rules('facebook', 'Facebook', 'valid_url');
		$this->form_validation->set_rules('twitter', 'Twitter', 'valid_url');
		$this->form_validation->set_rules('youtube', 'Youtube', 'valid_url');
    }

}