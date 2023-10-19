<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foto extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/foto_model');
    } 
    
    function index()
	{	
        $this->foto_model->tambah_foto();
		$data['title'] = 'Foto';
		$data['album'] = $this->db->select('*')->from('tb_album')->where('is_active',1)->order_by('id_album','desc')->get();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/foto/foto', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/foto/script');
    }

    function get_data_foto()
	{	
		$list = $this->foto_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {
            if($r->foto != '' AND file_exists("assets/img/foto/$r->foto"))
            {
				$img = '<a href="'.base_url("assets/img/foto/$r->foto").'" target="_blank">
							<img src="'.base_url("assets/img/foto/$r->foto").'" class="img img-fluid" width="150px">
						</a>'; 
            }else
            {
				$img = '';
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<div class="text-center">'.$img.'</div>';
			$row[] = $r->album;
			$row[] = '<div class="text-center">'.date('d-m-Y H:i:s', strtotime($r->uploaded_on)).'</div>';
			$action = '<div class="text-center">
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-foto/$r->id_foto").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->foto_model->count_all(),
			"recordsFiltered" => $this->foto_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    
    function hapus_foto($id)
	{ 
        $cek = $this->foto_model->cek_foto($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->foto_model->hapus_foto($id);
        }
    }

}