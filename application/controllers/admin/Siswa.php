<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/siswa_model');
    } 
    
    function index()
	{	
        $data['title'] = 'Peserta Didik';
        $data['data'] = $this->siswa_model->tampil_siswa();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/siswa/siswa', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/siswa/script');
	}
	
	function tambah_siswa()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 
				$this->siswa_model->tambah_siswa();
			}
		}
		$data['title'] = 'Tambah Peserta Didik';
		$data['tahun'] = $this->db->query("SELECT * FROM tb_tahun WHERE NOT EXISTS (SELECT id_siswa,id_tahun FROM tb_siswa WHERE tb_tahun.id_tahun = tb_siswa.id_tahun) ORDER BY tahun DESC");
		$data['profil'] = $this->db->select('id,jenjang')->from('tb_profil')->where('id',1)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/siswa/form_tambah_siswa', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/siswa/script');
	}

	function edit_siswa($id)
	{ 
		$cek = $this->siswa_model->cek_siswa($id); 
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
					$this->siswa_model->edit_siswa($id);
				}
			}
			$data['title'] = 'Edit Peserta Didik';
			$data['data'] = $this->db->select('*')->from('tb_siswa')->where('id_siswa',$id)->get()->row();
			$data['tahun'] = $this->db->query("SELECT * FROM tb_tahun WHERE NOT EXISTS (SELECT id_siswa,id_tahun FROM tb_siswa WHERE tb_tahun.id_tahun = tb_siswa.id_tahun AND tb_siswa.id_siswa != $id) ORDER BY tahun DESC");
			$data['profil'] = $this->db->select('id,jenjang')->from('tb_profil')->where('id',1)->get()->row();
			//layout
			$this->load->view('admin/template/head');
			$this->load->view('admin/template/topbar');
			$this->load->view('admin/template/nav');
			$this->load->view('admin/siswa/form_edit_siswa', $data);
			$this->load->view('admin/template/js');
			$this->load->view('admin/siswa/script');
		}
	}

	function hapus_siswa($id)
	{ 
		$cek = $this->siswa_model->cek_siswa($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
			$this->siswa_model->hapus_siswa($id);
		}
	}

	private function _validation()
	{
		$this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
		$this->form_validation->set_rules('id_tahun', 'Tahun Pelajaran', 'required|numeric');
		$this->form_validation->set_rules('jml1pa', 'Jumlah Putra', 'required|numeric');
		$this->form_validation->set_rules('jml1pi', 'Jumlah Putri', 'required|numeric');
		$this->form_validation->set_rules('jml2pa', 'Jumlah Putra', 'required|numeric');
		$this->form_validation->set_rules('jml2pi', 'Jumlah Putri', 'required|numeric');
		$this->form_validation->set_rules('jml3pa', 'Jumlah Putra', 'required|numeric');
		$this->form_validation->set_rules('jml3pi', 'Jumlah Putri', 'required|numeric');
	}

}