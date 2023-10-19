<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banner extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/banner_model');
    }

    function index()
	{	
        $data['title'] = 'Banner Web';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/banner/banner', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/banner/script');
    }

    function get_data_banner()
	{	
		$list = $this->banner_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			$target = "assets/img/banner/$r->gambar";
            if($r->gambar != '' AND file_exists($target))
            {
				$img = '<a href="'.base_url("assets/img/banner/$r->gambar").'" target="_blank">
							<img src="'.base_url("assets/img/banner/$r->gambar").'" class="img img-fluid" width="100px">
						</a>'; 
			}else{
				$img = '';
			}

            if($r->is_active == '1')
            {
				$status = '<span class="badge badge-primary">Aktif</span>';
            }else
            {
				$status = '<span class="badge badge-danger">Non Aktif</span>';
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $img;
			$row[] = $r->judul;
			$row[] = $r->keterangan;
            $row[] = $r->link;
			$row[] = $r->button;
			$row[] = '<div class="text-center">'.$status.'</div>';
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-banner/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-banner/$r->id").'" title="HAPUS DATA">HAPUS</a>
                    </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->banner_model->count_all(),
			"recordsFiltered" => $this->banner_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

    function tambah_banner()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();	
			if($this->form_validation->run() == TRUE)
			{ 	
                $this->banner_model->tambah_banner();   
            }
		}
		$data['title'] = 'Tambah Banner Web';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/banner/form_tambah_banner', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/banner/script');
    }

    function edit_banner($id)
	{ 
        $cek = $this->banner_model->cek_banner($id); 
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
                    $this->banner_model->edit_banner($id);   
                }
            }
        }
        $data['title'] = 'Edit Banner Web';
        $data['data'] = $this->db->select('*')->from('tb_banner')->where('id',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/banner/form_edit_banner', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/banner/script');
    }

    function hapus_banner($id)
	{ 
        $cek = $this->banner_model->cek_banner($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {    	
            $this->banner_model->hapus_banner($id);   
        }
    }
    
    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('is_active', 'Status Aktif', 'required');		
    }

}