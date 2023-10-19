<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
		$this->load->library('template');
		$this->load->model('admin/pengaduan_model');
    }

   function index()
	{	
		$data['title'] = 'Pengaduan';
		 $data['data'] = $this->pengaduan_model->tampil_pengaduan();
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/pengaduan/pengaduan', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/pengaduan/script');
	}

    function get_data_pengaduan()
	{	
		$list = $this->pengaduan_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach($list as $r)
        {	
			if(strlen($r->isi) > 200)
            {
				$isi = substr($r->isi,0,200); 
				$pengaduan = substr($r->isi,0,strrpos($isi," ")). '...';
            }else
            {
				$pengaduan = $r->isi;
			}

            if($r->status == 1)
            {
                $status = 'Peserta Didik';
            }elseif($r->status == 2)
            {
                $status = 'Wali Murid';
            }elseif($r->status == 3)
            {
                $status = 'Masyarakat';
            }else
            {
                $status = '';
            }

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $r->nama;
            $row[] = $status;
			$row[] = $pengaduan;
			$row[] = '<div class="text-center">
                        <a href="javascript:void(0)" onclick="detail('.$r->id.')" class="btn btn-primary btn-xs" title="LIHAT DETAIL">DETAIL</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
                        data-href="'.base_url("backend/hapus-pengaduan/$r->id").'" title="HAPUS DATA">HAPUS</a>
                    </div>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pengaduan_model->count_all(),
			"recordsFiltered" => $this->pengaduan_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    } 

    function detail_pengaduan($id)
	{ 
        $cek = $this->pengaduan_model->cek_pengaduan($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $data['title'] = 'Detail Pengaduan';
            $data['data'] = $this->db->get_where('tb_pengaduan', ['id'=>$id])->row();
            //layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/pengaduan/detail_pengaduan', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/pengaduan/script');
        }
    }

    function lihat_pengaduan($id)
	{ 
        $data = $this->db->get_where('tb_pengaduan', ['id'=>$id])->row();
        echo json_encode($data);
    }

    function hapus_pengaduan($id)
	{ 
        $cek = $this->pengaduan_model->cek_pengaduan($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->pengaduan_model->hapus_pengaduan($id);  
        }
    }

}