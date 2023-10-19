<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('web/guru_model','web/home_model'));
    }
    
    function index()
    {
        $this->guru();
    }

    function guru()
    {
        $data['titleweb'] = 'Tenaga Edukatif - '.title();
        $data['title'] = 'Tenaga Edukatif';
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('guru/guru', $data);
		$this->load->view('template/footer');
        $this->load->view('guru/script');
    }

    function get_data_guru()
	{
		$list = $this->guru_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<a href="'.base_url("guru/detail/$r->id").'" target="_blank"><b>'.$r->nama.'</b></a>';
			$row[] = $r->nip;
            $row[] = $r->nuptk;
            $row[] = $r->alamat;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->guru_model->count_all(),
			"recordsFiltered" => $this->guru_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function detail($id)
    {
        $cek = $this->guru_model->cek_guru($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $data['titleweb'] = 'Detail Guru - '.title();
            $data['title'] = 'Detail Guru';
            $data['data'] = $this->guru_model->detail($id);
            //layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('guru/detail_guru', $data);
            $this->load->view('template/footer');
            $this->load->view('guru/script');
        }
    }   

}