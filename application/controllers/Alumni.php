<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('web/alumni_model','web/home_model'));
		$this->load->helper('captcha');
    }

    function index()
    {
        $data['titleweb'] = 'Data Alumni - '.title();
		$data['title'] = 'Data Alumni';
		$data['data'] = $this->alumni_model->tampil_alumni();
       	//layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('alumni/alumni', $data);
		$this->load->view('template/footer');
		$this->load->view('alumni/script');
    }

    function penelusuran_alumni()
    {
        if($this->input->post('submit', TRUE) == 'Submit')
		{ 
            $this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->alumni_model->isi_alumni();
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
		
        $data['titleweb'] = 'Penelusuran Alumni - '.title();
		$data['title'] = 'Penelusuran Alumni';
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('alumni/isi_alumni', $data);
		$this->load->view('template/footer');
		$this->load->view('alumni/script');
    }

    function get_data_isialumni()
	{
		$list = $this->alumni_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {
            if($r->gambar != '' AND file_exists("assets/img/alumni/$r->gambar"))
            {
				$img = '<a href="'.base_url("assets/img/alumni/$r->gambar").'" target="_blank"><img src="'.base_url("assets/img/alumni/$r->gambar").'" class="img img-fluid"></a>'; 
            }else
            {
				$img = '';
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = cetak($r->nama);
			$row[] = cetak($r->th_lulus);
			if(jenjang() == 1 OR jenjang() == 3)
            { 
				$row[] = $r->sma;
				$row[] = $r->pt;
			}elseif(jenjang() == 2 OR jenjang() == 4)
            { 
				$row[] = $r->pt;
			}
			$row[] = cetak($r->instansi);
			$row[] = cetak($r->alamatins);
			$row[] = cetak($r->hp);
			$row[] = cetak($r->email);
			$row[] = cetak($r->alamat);
			$row[] = cetak($r->kesan);
			$row[] = '<div class="text-center">'.$img.'</div>';
			$row[] =  date('d-m-Y', strtotime($r->tglpost));
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->alumni_model->count_all(),
			"recordsFiltered" => $this->alumni_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('th_lulus', 'Tahun Lulus', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('secutity_code', 'Captcha', 'required');
    }

}