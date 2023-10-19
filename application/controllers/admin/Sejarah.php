<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
        $this->load->model('admin/sejarah_model');
	} 

	function index()
	{	
        $data['title'] = 'Sejarah';
        $data['data'] = $this->sejarah_model->tampil_sejarah();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/sejarah/sejarah', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/sejarah/script');
    }	

    function edit_sejarah()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
        { 
            $this->sejarah_model->edit_sejarah();
		}
        $data['title'] = 'Edit Sejarah';
        $data['data'] = $this->sejarah_model->tampil_sejarah();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/sejarah/form_sejarah', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/sejarah/script');
    }

}