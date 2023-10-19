<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/guru_model');
    }

    function index()
	{	
		$data['title'] = 'Guru';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/guru/guru', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/guru/script');
    }

    function get_data_guru()
	{
		$list = $this->guru_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			if($r->jk == 1)
			{
				$jk = 'L';
			}elseif($r->jk == 2)
			{
				$jk = 'P';
			}

			if($r->gambar != '' AND file_exists("assets/img/guru/$r->gambar"))
            {
				$img = '<a href="'.base_url("assets/img/guru/$r->gambar").'" target="_blank">
							<img src="'.base_url("assets/img/guru/$r->gambar").'" class="img img-fluid" width="100px">
						</a>'; 
            }else
            {
				$img = '';
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->nama;
			$row[] = $r->nip;
			$row[] = '<div class="text-center">'.$jk.'</div>';
			$row[] = $r->statuspeg;
			$row[] = $r->statusguru;
			$row[] = $r->status;
			$row[] = '<div class="text-center">'.$img.'</div>';
			$action = '<div class="text-center">
						<a href="javascript:void(0)" onclick="detail('.$r->id.')" class="btn btn-primary btn-xs" title="LIHAT DETAIL">DETAIL</a>
						<a href="'.base_url("backend/edit-guru/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-guru/$r->id").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
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
    
    function tambah_guru()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->guru_model->tambah_guru();
			}
		}
		$data['title'] = 'Tambah Guru';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/guru/form_tambah_guru', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/guru/script');
    }

    function edit_guru($id)
	{ 
        $cek = $this->guru_model->cek_guru($id); 
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
                    $this->guru_model->edit_guru($id);
                }
            }
        }
        $data['title'] = 'Edit Guru';
        $data['data'] = $this->db->select('*')->from('tb_guru')->where('id',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/guru/form_edit_guru', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/guru/script');
    }

	function detail_guru($id)
	{ 
        $cek = $this->guru_model->cek_guru($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
			$data['title'] = 'Detail Guru';
			$data['data'] = $this->db->get_where('tb_guru', ['id'=>$id])->row();
			//layout
			$this->load->view('admin/template/head');
			$this->load->view('admin/template/topbar');
			$this->load->view('admin/template/nav');
			$this->load->view('admin/guru/detail_guru', $data);
			$this->load->view('admin/template/js');
			$this->load->view('admin/guru/script');
        }
    }

	function lihat_guru($id)
	{ 
        $data = $this->db->get_where('tb_guru', ['id'=>$id])->row();
        echo json_encode($data);
    }

    function hapus_guru($id)
	{ 
        $cek = $this->guru_model->cek_guru($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->guru_model->hapus_guru($id);
        }
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('statuspeg', 'Status Pegawai', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('statusguru', 'Status Guru', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
    }

}