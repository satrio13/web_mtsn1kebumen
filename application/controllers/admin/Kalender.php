<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalender extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/kalender_model');
    }

    function index()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->kalender_model->edit_kalender();
		}
        $data['title'] = 'Kalender Akademik';
        $data['data'] = $this->db->select('*')->from('tb_kalender')->where('id',1)->get()->row();  
 	 	//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/kalender/form_kalender', $data);
		$this->load->view('admin/template/js');
    }

}