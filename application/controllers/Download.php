<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model(array('web/download_model','web/home_model'));
	} 

    function index()
    {
        $data['titleweb'] = 'Download - '.title();
        $data['title'] = 'Download';
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('download/download', $data);
		$this->load->view('template/footer');
		$this->load->view('download/script');
    }

    function get_data_download()
	{
		$list = $this->download_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->nama_file;
			$row[] = date('d-m-Y', strtotime($r->tgl_upload));
            $row[] = '<div class="text-center">'.$r->hits.'</div>';
            $action = '<div class="text-center">
                        <a href="'.base_url("download/hits/$r->file").'" class="btn btn-outline-dark btn-sm" title="DOWNLOAD"><i class="fa fa-download"></i></a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->download_model->count_all(),
			"recordsFiltered" => $this->download_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    } 
    
    function hits($file)
    {
        $cek = $this->download_model->cek_download($file); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $get = $this->db->get_where('tb_download',['file'=>$file])->row();
            $hits = $get->hits+1;
            $this->db->update('tb_download', ['hits'=>$hits], ['file'=>$file]);
            $this->load->helper('download');
            $target = "assets/file/$file";
            force_download($target,NULL);
        }
	}
	
    function file($file)
    {
        $cek = $this->download_model->cek_file($file); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->load->helper('download');
            $target = "assets/file/$file";
            force_download($target,NULL);
        }
    }

}