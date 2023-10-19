<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('web/home_model');
	} 

    function index()
    {
		$data['titleweb'] = title();
		$data['banner'] = $this->home_model->tampil_banner();
		$data['agenda'] = $this->home_model->tampil_agenda();
		$data['pengumuman'] = $this->home_model->tampil_pengumuman();
		$data['berita'] = $this->home_model->tampil_berita();
		$data['link'] = $this->home_model->tampil_link();
		$data['alumni'] = $this->home_model->tampil_alumni();
		$data['download'] = $this->home_model->tampil_download();
		$data['ekstrakurikuler'] = $this->home_model->tampil_ekstrakurikuler();
		$data['album'] = $this->home_model->tampil_album();
		$data['video'] = $this->home_model->tampil_video();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('home', $data);
		$this->load->view('template/footer');
		$this->load->view('script');
	}
	
}