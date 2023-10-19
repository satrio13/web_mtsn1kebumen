<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->model(array('web/pengaduan_model','web/home_model'));
		$this->load->helper('captcha');
    }

    function index()
    {
        if($this->input->post('submit', TRUE) == 'SubmitPengaduan')
		{ 
            $this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->pengaduan_model->tambah_pengaduan();
			}
		}

	    $config_captcha = array(
			'word'          => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5),
			'img_path'      => './captcha/',
			'img_url'       => base_url('captcha/'),
			'img_width'     => 150,
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 5,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => [
					'background'=> [255, 255, 255],
					'border'    => [255, 255, 255],
					'text'      => [0, 0, 0],
					'grid'      => [255, 40, 40]
			]
		);
		  
		// create captcha image
		$cap = create_captcha($config_captcha);
		// store image html code in a variable
		$data['img'] = $cap['image'];
		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);
		
        $data['titleweb'] = 'Layanan Pengaduan - '.title();
		$data['title'] = 'Layanan Pengaduan';
		//layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('pengaduan/pengaduan', $data);
		$this->load->view('template/footer');
		$this->load->view('pengaduan/script');
	}
	
    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('status', 'Status', 'required|numeric');
		$this->form_validation->set_rules('isi', 'Uraian Pengaduan', 'required');
		$this->form_validation->set_rules('secutity_code', 'Captcha', 'required');
    }

}