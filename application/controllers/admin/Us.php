<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Us extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/us_model');
    }

    function index()
	{	
		$data['title'] = 'Rekap US / UM';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/rekap_us/rekap_us', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/rekap_us/script');
	}

	function get_data_us()
	{	
		$list = $this->us_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach($list as $r)
		{
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->tahun;
			$row[] = $r->mapel;
			$row[] = '<div class="text-center">'.$r->tertinggi.'</div>';
			$row[] = '<div class="text-center">'.$r->terendah.'</div>';
			$row[] = '<div class="text-center">'.$r->rata.'</div>';
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-rekap-us/$r->id_us").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-rekap-us/$r->id_us").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->us_model->count_all(),
			"recordsFiltered" => $this->us_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 
	
	function tambah_rekap_us()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 
				$this->us_model->tambah_rekap_us();
			}
		}
		$data['title'] = 'Tambah Rekap US / UM';
		$data['tahun'] = $this->db->select('*')->from('tb_tahun')->order_by('tahun','desc')->get();
		$data['mapel'] = $this->db->select('*')->from('tb_kurikulum')->where('is_active',1)->order_by('mapel','asc')->get();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/rekap_us/form_tambah_us', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/rekap_us/script');
	}

	function edit_rekap_us($id)
	{ 
		$cek = $this->us_model->cek_us($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
			if($this->input->post('submit', TRUE) == 'Submit')
			{ 
				$this->_validation();
				if($this->form_validation->run() == TRUE)
				{ 
					$this->us_model->edit_rekap_us($id);
				}
			}
		}
		$data['title'] = 'Edit Rekap US / UM';
		$data['data'] = $this->db->select('*')->from('tb_rekap_us')->where('id_us',$id)->get()->row();
		$data['tahun'] = $this->db->select('*')->from('tb_tahun')->order_by('tahun','desc')->get();
		$data['mapel'] = $this->db->select('*')->from('tb_kurikulum')->where('is_active',1)->order_by('mapel','asc')->get();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/rekap_us/form_edit_us', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/rekap_us/script');
	}

	function hapus_rekap_us($id)
	{ 
		$cek = $this->us_model->cek_us($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {		
			$this->us_model->hapus_rekap_us($id);
		}
	}

	private function _validation()
	{
		$this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
		$this->form_validation->set_rules('id_kurikulum', 'Mata Pelajaran', 'required');
		$this->form_validation->set_rules('id_tahun', 'Tahun Pelajaran', 'required');
	}
    
}