<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur_organisasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
        $this->load->model('admin/struktur_organisasi_model');
	} 

	function index()
	{	
        $data['title'] = 'Struktur Organisasi';
        $data['data'] = $this->struktur_organisasi_model->tampil_struktur_organisasi();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/struktur_organisasi/struktur_organisasi', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/struktur_organisasi/script');
    }	

    function edit_struktur_organisasi()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
        { 
            $this->struktur_organisasi_model->edit_struktur_organisasi();
		}
        $data['title'] = 'Edit Struktur Organisasi';
        $data['data'] = $this->struktur_organisasi_model->tampil_struktur_organisasi();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/struktur_organisasi/form_struktur_organisasi', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/struktur_organisasi/script');
    }

}