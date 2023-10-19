<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/download_model');
    }

    function index()
	{	
		$data['title'] = 'Download';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/download/download', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/download/script');
	}

	function get_data_download()
	{
		$list = $this->download_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
            if($r->is_active == 1)
            {
				$status = '<span class="badge badge-primary">Aktif</span>';
            }else
            {
				$status = '<span class="badge badge-danger">Non Aktif</span>';
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->nama_file;
			$row[] = '<a href="'.base_url("assets/file/$r->file").'" target="_blank">'.$r->file.'</a>';
			$row[] = date('d-m-Y', strtotime($r->tgl_upload));
			$row[] = $r->hits;
			$row[] = $r->nama;
			$row[] = '<div class="text-center">'.$status.'</div>';
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-download/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-download/$r->id").'" title="HAPUS DATA">HAPUS</a>
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

    function tambah_download()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
            $this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->download_model->tambah_download();
			}
		}
		$data['title'] = 'Tambah File Download';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/download/form_tambah_download', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/download/script');
    }

    function edit_download($id)
	{ 
        $cek = $this->download_model->cek_download($id); 
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
                    $this->download_model->edit_download($id);
                }
            }
        }
        $data['title'] = 'Edit File Download';
        $data['data'] = $this->db->select('*')->from('tb_download')->where('id',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/download/form_edit_download', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/download/script');
    }

    function hapus_download($id)
	{ 
        $cek = $this->download_model->cek_download($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {    	
            $this->download_model->hapus_download($id);
        }
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama_file', 'Nama File', 'required');
        $this->form_validation->set_rules('is_active', 'Status', 'required');
    }
       		
}