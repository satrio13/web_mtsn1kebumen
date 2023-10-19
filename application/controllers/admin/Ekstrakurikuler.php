<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekstrakurikuler extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
        
		$this->load->model('admin/ekstakurikuler_model');
	} 

    function index()
	{	
        $data['title'] = 'Ekstrakurikuler';
        $data['data'] = $this->ekstakurikuler_model->tampil_ekstrakurikuler();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/ekstrakurikuler/ekstrakurikuler', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/ekstrakurikuler/script');
    }

    function tambah_ekstrakurikuler()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->ekstakurikuler_model->tambah_ekstrakurikuler();
			}
		}
        $data['title'] = 'Tambah Ekstrakurikuler';
        //layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/ekstrakurikuler/form_tambah_ekstrakurikuler', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/ekstrakurikuler/script');
    }

    function edit_ekstrakurikuler($id)
	{ 
        $cek = $this->ekstakurikuler_model->cek_ekstrakurikuler($id); 
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
                    $this->ekstakurikuler_model->edit_ekstrakurikuler($id);
                }
            }
        }
        $data['title'] = 'Edit Ekstrakurikuler';
        $data['data'] = $this->db->get_where('tb_ekstrakurikuler',['id'=>$id])->row();
        //layout
        $this->load->view('admin/template/head');
        $this->load->view('admin/template/topbar');
        $this->load->view('admin/template/nav');
        $this->load->view('admin/ekstrakurikuler/form_edit_ekstrakurikuler', $data);
        $this->load->view('admin/template/js');
        $this->load->view('admin/ekstrakurikuler/script');
    }

    function hapus_ekstrakurikuler($id)
	{ 
        $cek = $this->ekstakurikuler_model->cek_ekstrakurikuler($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->ekstakurikuler_model->hapus_ekstrakurikuler($id);    
        }
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama_ekstrakurikuler', 'Nama Ekstrakurikuler', 'required');
    }

}