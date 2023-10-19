<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
        
		$this->load->model('admin/program_model');
    }

    function index()
	{	
		$data['title'] = 'Program';
		$data['data'] = $this->program_model->tampil_program();
  		$this->template->admin('admin/dashboard','admin/program/program', $data);
	}

	function edit_program($id)
	{   
        $cek = $this->program_model->cek_program($id); 
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
					$this->program_model->edit_program($id);
				}
            }
        }
        $data['title'] = 'Edit Program';
        $data['data'] = $this->db->select('*')->from('tb_program')->where('id',$id)->get()->row();
		$this->template->admin('admin/dashboard','admin/program/form_edit_program',$data);
	}

	function hapus_program($id)
	{   
        $cek = $this->program_model->cek_program($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->program_model->hapus_program($id);
        }
	}

	private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    }

}