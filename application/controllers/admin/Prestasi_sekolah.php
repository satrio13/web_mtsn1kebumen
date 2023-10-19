<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_sekolah extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/prestasi_sekolah_model');
    }

    function index()
	{	
		if(jenjang() == 1 OR jenjang() == 2)
		{
			$data['title'] = 'Prestasi Sekolah';
		}else
		{
			$data['title'] = 'Prestasi Madrasah';
		}
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/prestasi/prestasi_sekolah', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/prestasi/script');
    }

    function get_data_prestasi_sekolah()
	{
		$list = $this->prestasi_sekolah_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {
            if($r->jenis == '1')
            {
				$jenis = 'Akademik';
            }else
            {
				$jenis = 'Non Akademik';
			}

            if($r->tingkat == '1')
            {
				$kab = '<i class="fa fa-check"></i>';
            }else
            {
				$kab = '';
			}

            if($r->tingkat == '2')
            {
				$kar = '<i class="fa fa-check"></i>';
            }else
            {
				$kar = '';
			}

            if($r->tingkat == '3')
            {
				$prov = '<i class="fa fa-check"></i>';
            }else
            {
				$prov = '';
			}

            if($r->tingkat == '4')
            {
				$nas = '<i class="fa fa-check"></i>';
            }else
            {
				$nas = '';
			}

            if($r->tingkat == '5')
            {
				$int = '<i class="fa fa-check"></i>';
            }else
            {
				$int = '';
			}

			$target = "assets/img/prestasi/sekolah/$r->gambar";
            if($r->gambar != '' AND file_exists($target))
            {
				$img = '<a href="'.base_url("assets/img/prestasi/sekolah/$r->gambar").'" target="_blank">
							<img src="'.base_url("assets/img/prestasi/sekolah/$r->gambar").'" class="img img-fluid" width="100px">
						</a>'; 
            }else
            {
				$img = '';
			}
			
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->tahun;
			$row[] = $r->nama;
			$row[] = $jenis;
			$row[] = 'Juara '.$r->prestasi;
			$row[] = '<div class="text-center">'.$kab.'</div>';
			$row[] = '<div class="text-center">'.$kar.'</div>';
			$row[] = '<div class="text-center">'.$prov.'</div>';
			$row[] = '<div class="text-center">'.$nas.'</div>';
			$row[] = '<div class="text-center">'.$int.'</div>';
			$row[] = $r->keterangan;
			$row[] = '<div class="text-center">'.$img.'</div>';
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-prestasi-sekolah/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-prestasi-sekolah/$r->id").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->prestasi_sekolah_model->count_all(),
			"recordsFiltered" => $this->prestasi_sekolah_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	} 

    function tambah_prestasi_sekolah()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
            $this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->prestasi_sekolah_model->tambah_prestasi_sekolah();
			}
		}
        if(jenjang() == 1 OR jenjang() == 2)
		{
			$data['title'] = 'Tambah Prestasi Sekolah';
		}else
		{
			$data['title'] = 'Tambah Prestasi Madrasah';
		}
        $data['tahun'] = $this->db->select('*')->from('tb_tahun')->order_by('tahun','desc')->get();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/prestasi/form_tambah_prestasi_sekolah', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/prestasi/script');
    }
    
    function edit_prestasi_sekolah($id)
	{ 
        $cek = $this->prestasi_sekolah_model->cek_prestasi_sekolah($id); 
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
                    $this->prestasi_sekolah_model->edit_prestasi_sekolah($id);
                }
            }
            if(jenjang() == 1 OR jenjang() == 2)
			{
				$data['title'] = 'Edit Prestasi Sekolah';
			}else
			{
				$data['title'] = 'Edit Prestasi Madrasah';
			}
            $data['tahun'] = $this->db->select('*')->from('tb_tahun')->order_by('tahun','desc')->get();
            $data['data'] = $this->db->get_where('tb_prestasi_sekolah',['id'=>$id])->row();
            //layout
			$this->load->view('admin/template/head');
			$this->load->view('admin/template/topbar');
			$this->load->view('admin/template/nav');
			$this->load->view('admin/prestasi/form_edit_prestasi_sekolah', $data);
			$this->load->view('admin/template/js');
			$this->load->view('admin/prestasi/script');
        }        
    }
    
    function hapus_prestasi_sekolah($id)
	{ 
        $cek = $this->prestasi_sekolah_model->cek_prestasi_sekolah($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->prestasi_sekolah_model->hapus_prestasi_sekolah($id);
        }        
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
		$this->form_validation->set_rules('nama', 'Nama Lomba', 'required');
    }
   
}