<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('web/karyawan_model','web/home_model'));
    }
    
    function index()
    {
        $this->karyawan();
    }

    function karyawan()
    {
        $data['titleweb'] = 'Tenaga Non Edukatif - '.title();
        $data['title'] = 'Tenaga Non Edukatif';
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('karyawan/karyawan', $data);
        $this->load->view('template/footer');
        $this->load->view('karyawan/script');
    }

    function get_data_karyawan()
	{
		$list = $this->karyawan_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<a href="'.base_url("karyawan/detail/$r->id").'" target="_blank"><b>'.$r->nama.'</b></a>';
			$row[] = $r->nip;
            $row[] = $r->nuptk;
            $row[] = $r->alamat;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->karyawan_model->count_all(),
			"recordsFiltered" => $this->karyawan_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }

    function detail($id)
    {
        $cek = $this->karyawan_model->cek_karyawan($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $data['titleweb'] = 'Detail Karyawan - '.title();
            $data['title'] = 'Detail Karyawan';
            $data['data'] = $this->karyawan_model->detail($id);
             //layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('karyawan/detail_karyawan', $data);
            $this->load->view('template/footer');
            $this->load->view('karyawan/script');
        }
    }

}