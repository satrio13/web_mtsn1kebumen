<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		
		$this->load->model('admin/agenda_model');
	} 

    function index()
	{	
		$data['title'] = 'Agenda';
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/agenda/agenda', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/agenda/script');
	}

	function get_data_agenda()
	{
		$list = $this->agenda_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {
            if(strlen($r->keterangan) > 200)
            {
				$isi = substr($r->keterangan,0,200); 
				$keterangan = substr($r->keterangan,0,strrpos($isi," ")). '... <a href="'.base_url("agenda/detail/$r->slug").'" target="_blank"><b>Lihat Detail</b></a>';
            }else
            {
				$keterangan = $r->keterangan;
			}

            if($r->berapa_hari == 2 AND $r->tgl_mulai != '0000-00-00' AND $r->tgl_selesai != '0000-00-00')
            {
				$tgl = date('d-m-Y', strtotime($r->tgl_mulai)).' s.d. '.date('d-m-Y', strtotime($r->tgl_selesai));
            }elseif($r->berapa_hari == 1 AND $r->tgl != '0000-00-00')
            {
				$tgl = date('d-m-Y', strtotime($r->tgl));
            }else
            {
				$tgl = "";
			}

            if($r->jam_mulai != '' AND $r->jam_selesai != '')
            {
				$jam = date('H:i', strtotime($r->jam_mulai)).' s.d. '.date('H:i', strtotime($r->jam_selesai));
            }else
            {
				$jam = "";
			}

            if($r->gambar != '' AND file_exists("assets/img/agenda/$r->gambar"))
            {
				$img = '<a href="'.base_url("assets/img/agenda/$r->gambar").'" target="_blank">
							<img src="'.base_url("assets/img/agenda/$r->gambar").'" class="img img-fluid" width="100px">
						</a>'; 
            }else
            {
				$img = '';
			}
			
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->nama_agenda;
			$row[] = $keterangan;
			$row[] = $tgl;
			$row[] = $jam;
			$row[] = $r->tempat;
			$row[] = $img;
			$action = '<div class="text-center">
						<a href="'.base_url("backend/edit-agenda/$r->id").'" class="btn btn-info btn-xs" title="EDIT DATA">EDIT</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-agenda/$r->id").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->agenda_model->count_all(),
			"recordsFiltered" => $this->agenda_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    } 
    
    function tambah_agenda()
	{ 
		if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 	
				$this->agenda_model->tambah_agenda();
			}
		}
        $data['title'] = 'Tambah Agenda';
        $data['berapa_hari'] = $this->input->post('submit', TRUE);
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/agenda/form_tambah_agenda', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/agenda/script');
    }
    
    function edit_agenda($id)
	{ 
        $cek = $this->agenda_model->cek_agenda($id); 
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
                    $this->agenda_model->edit_agenda($id);
                }
            }
        }
        $data['title'] = 'Edit Agenda';
        $data['data'] = $this->db->select('*')->from('tb_agenda')->where('id',$id)->get()->row();
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/agenda/form_edit_agenda', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/agenda/script');
    }

    function hapus_agenda($id)
	{ 
        $cek = $this->agenda_model->cek_agenda($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->agenda_model->hapus_agenda($id);
        }
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('nama_agenda', 'Nama Agenda', 'required');
        $this->form_validation->set_rules('berapa_hari', 'Berapa Hari', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
    }

}