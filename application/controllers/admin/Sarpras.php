<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sarpras extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
        $this->load->model('admin/sarpras_model');
	} 

	function index()
	{	
        $data['title'] = 'Sarpras';
        $data['data'] = $this->sarpras_model->tampil_sarpras();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/sarpras/sarpras', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/sarpras/script');
    }

    function edit_sarpras()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
        { 
            $this->sarpras_model->edit_sarpras();
		}
        $data['title'] = 'Edit Sarpras';
        $data['data'] = $this->sarpras_model->tampil_sarpras();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/sarpras/form_sarpras', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/sarpras/script');
    }

}