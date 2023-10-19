<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
	    $this->load->model('admin/auth_model');
	} 

	function index()
	{	
		redirect('auth/login');
    }
    
    function login()
	{	
        $this->auth_model->login();
        $data['logo'] = $this->db->select('id,logo_admin')->from('tb_profil')->where('id',1)->get()->row();
        $this->load->view('admin/auth/login', $data);
    }

    function logout()
    {  
        $this->auth_model->logout();
    }
    
}