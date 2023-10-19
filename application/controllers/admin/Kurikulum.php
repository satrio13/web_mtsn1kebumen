<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
        
		$this->load->model('admin/kurikulum_model');
    }

    function index()
	{	
		$data['data'] = $this->kurikulum_model->tampil_kurikulum();
		$data['title'] = 'Kurikulum';
  	    //layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/kurikulum/kurikulum', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/kurikulum/script');
    }

    function tambah_kurikulum()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
            $this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->kurikulum_model->tambah_kurikulum();
			}
		}
		$data['title'] = 'Tambah Kurikulum';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/kurikulum/form_tambah_kurikulum', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/kurikulum/script');
    }
    
    function edit_kurikulum($id)
	{ 
        $cek = $this->kurikulum_model->cek_kurikulum($id); 
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
                    $this->kurikulum_model->edit_kurikulum($id);
                }
            }
        }
        $data['title'] = 'Edit Kurikulum';
        $data['data'] = $this->db->select('*')->from('tb_kurikulum')->where('id_kurikulum',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/kurikulum/form_edit_kurikulum', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/kurikulum/script');
    }

    function hapus_kurikulum($id)
	{ 
        $cek = $this->kurikulum_model->cek_kurikulum($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->kurikulum_model->hapus_kurikulum($id);  
        }
    }
    
    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('kelompok', 'Kelompok', 'required');
        $this->form_validation->set_rules('alokasi', 'Alokasi Waktu', 'required|numeric');
        $this->form_validation->set_rules('no_urut', 'No Urut', 'required|numeric');
        $this->form_validation->set_rules('is_active', 'Status', 'required');
    } 
    
}