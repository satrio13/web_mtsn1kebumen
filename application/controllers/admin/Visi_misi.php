<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visi_misi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
        $this->load->model('admin/visi_misi_model');
	} 

	function index()
	{	
        $data['title'] = 'Visi & Misi';
        $data['data'] = $this->visi_misi_model->tampil_visi_misi();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/visi_misi/visi_misi', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/visi_misi/script');
    }	

    function edit_visi_misi()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
        { 
            $this->visi_misi_model->edit_visi_misi();
		}
        $data['title'] = 'Edit Visi & Misi';
        $data['data'] = $this->visi_misi_model->tampil_visi_misi();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/visi_misi/form_visi_misi', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/visi_misi/script');
    }

}