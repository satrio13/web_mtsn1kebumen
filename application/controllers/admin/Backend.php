<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/alumni_model');
	} 

	function index()
	{	
		$data['title'] = 'Hasil Penelusuran Alumni';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/home', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/alumni/script');
	}	
	
}	