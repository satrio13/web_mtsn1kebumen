<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model(array('web/siswa_model','web/home_model'));
	} 

    function index()
    {
        $data['titleweb'] = 'Peserta Didik - '.title();
        $data['title'] = 'Peserta Didik';
        $data['data'] = $this->siswa_model->tampil_siswa();
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('siswa/siswa', $data);
        $this->load->view('template/footer');
    }
    
}