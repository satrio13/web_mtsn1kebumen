<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/pengumuman_model');
    }
    
    function index()
	{	
		$data['title'] = 'Pengumuman';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/pengumuman/pengumuman', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/pengumuman/script');
	}
	
	function get_data_pengumuman()
	{	
		$list = $this->pengumuman_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {
            if(strlen($r->isi) > 200)
            {
				$isi = substr($r->isi,0,200); 
				$pengumuman = substr($r->isi,0,strrpos($isi," ")). '...';
            }else
            {
				$pengumuman = $r->isi;
			}

            if($r->gambar!='' AND file_exists("assets/img/pengumuman/$r->gambar"))
            {
				$img = '<a href="'.base_url("assets/img/pengumuman/$r->gambar").'" target="_blank">
							<img src="'.base_url("assets/img/pengumuman/$r->gambar").'" class="img img-fluid" width="100px">
						</a>'; 
            }else
            {
				$img = '';
			}

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
			$row[] = $r->nama;
			$row[] = $pengumuman;
			$row[] = $img;
			$row[] = $r->nama_operator;
			$row[] = $r->hari. ', ' .date('d-m-Y', strtotime($r->tgl));
			$row[] = '<div class="text-center">'.$status.'</div>';
			$row[] = $r->dibaca.' Kali';
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-pengumuman/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-pengumuman/$r->id").'" title="HAPUS DATA">HAPUS</a>
					</div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengumuman_model->count_all(),
			"recordsFiltered" => $this->pengumuman_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    } 
    
    function tambah_pengumuman()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
                $this->pengumuman_model->tambah_pengumuman();
            }
		}
		$data['title'] = 'Tambah Pengumuman';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/pengumuman/form_tambah_pengumuman', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/pengumuman/script');
    }

    function edit_pengumuman($id)
	{   
        $cek = $this->pengumuman_model->cek_pengumuman($id); 
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
                    $this->pengumuman_model->edit_pengumuman($id);
                }
            }
        }
        $data['title'] = 'Edit Pengumuman';
        $data['data'] = $this->db->select('*')->from('tb_pengumuman')->where('id',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/pengumuman/form_edit_pengumuman', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/pengumuman/script');
    }

    function hapus_pengumuman($id)
	{   
        $cek = $this->pengumuman_model->cek_pengumuman($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->pengumuman_model->hapus_pengumuman($id);
        }
    }
    
    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama', 'Nama Pengumuman', 'required');
        $this->form_validation->set_rules('isi', 'Isi Pengumuman', 'required');
        $this->form_validation->set_rules('is_active', 'Status', 'required');
    }

}