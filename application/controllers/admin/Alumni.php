<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id_user'))
		{ 
			redirect('auth/login');
		}
        
		$this->load->model('admin/alumni_model');
    }
    
    function index()
	{								  
		$data['title'] = 'Data Alumni';
        $data['data'] = $this->alumni_model->tampil_alumni();	  
        //layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/alumni/alumni', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/alumni/script');
    }

    function tambah_alumni()
	{
        if($this->input->post('submit', TRUE) == 'Submit')
		{ 
			$this->_validation();
			if($this->form_validation->run() == TRUE)
			{ 
				$this->alumni_model->tambah_alumni();
			}
		}
        $data['title'] = 'Tambah Alumni';
        $data['tahun'] = $this->db->query("SELECT * FROM tb_tahun WHERE NOT EXISTS (SELECT id,id_tahun FROM tb_alumni WHERE tb_tahun.id_tahun = tb_alumni.id_tahun) ORDER BY tahun DESC");
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/alumni/form_tambah_alumni', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/alumni/script');
    }

    function edit_alumni($id)
    {
        $cek = $this->alumni_model->cek_alumni($id); 
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
                    $this->alumni_model->edit_alumni($id);
                }
            }
        }
        $data['title'] = 'Edit Alumni';
        $data['data'] = $this->db->select('*')->from('tb_alumni')->where('id',$id)->get()->row();
        $data['tahun'] = $this->db->query("SELECT * FROM tb_tahun WHERE NOT EXISTS (SELECT id,id_tahun FROM tb_alumni WHERE tb_tahun.id_tahun = tb_alumni.id_tahun AND id != $id) ORDER BY tahun DESC");
		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/alumni/form_edit_alumni', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/alumni/script');
    }

    function hapus_alumni($id)
    {
        $cek = $this->alumni_model->cek_alumni($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->alumni_model->hapus_alumni($id);  
        }
    }

    function penelusuran_alumni()
	{	
		$data['title'] = 'Penelusuran Alumni';
  		//layout
		$this->load->view('admin/template/head');
		$this->load->view('admin/template/topbar');
		$this->load->view('admin/template/nav');
		$this->load->view('admin/alumni/isialumni', $data);
		$this->load->view('admin/template/js');
		$this->load->view('admin/alumni/script');
    }
    
    function get_data_isialumni()
	{	
		$list = $this->alumni_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
        foreach ($list as $r)
        {
            if($r->status == 0)
            {
				$status = '<a href="javascript:void(0)" onclick="status('.$r->id.')" class="badge badge-warning text-white" title="EDIT STATUS">Menunggu</a>';
            }elseif($r->status == 1)
            {
				$status = '<a href="javascript:void(0)" onclick="status('.$r->id.')" class="badge badge-primary" title="EDIT STATUS">Terpublish</a>';
            }elseif($r->status == 2)
            {
				$status = '<a href="javascript:void(0)" onclick="status('.$r->id.')" class="badge badge-danger" title="EDIT STATUS">Ditolak</a>';
			}
			
            if($r->gambar != '' AND file_exists("assets/img/alumni/$r->gambar"))
            {
				$img = '<a href="'.base_url("assets/img/alumni/$r->gambar").'" target="_blank">
                            <img src="'.base_url("assets/img/alumni/$r->gambar").'" class="img img-fluid" width="100px">
                        </a>'; 
            }else
            {
				$img = '';
			}
            
            if(strlen($r->kesan) > 200)
            {
				$isi = substr($r->kesan,0,200); 
				$kesan = substr($r->kesan,0,strrpos($isi," ")). '...';
            }else
            {
				$kesan = $r->kesan;
			}

			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<div class="text-center">'.$status.'</div>';
			$row[] = cetak($r->nama);
			$row[] = cetak($r->th_lulus);
			$row[] = cetak($r->alamat);
			$row[] = cetak($kesan);
			$row[] = '<div class="text-center>'.$img.'</div>';
			$row[] =  date('d-m-Y', strtotime($r->tglpost));
			$action = '<div class="text-center">
                        <a href="javascript:void(0)" onclick="detail('.$r->id.')" class="btn btn-primary btn-xs" title="LIHAT DETAIL">DETAIL</a>
                        <a href="javascript:void(0)" onclick="status('.$r->id.')" class="btn btn-info btn-xs">EDIT STATUS</a>
						<a href="javascript:void(0)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#konfirmasi_hapus" 
						data-href="'.base_url("backend/hapus-isialumni/$r->id").'" title="HAPUS DATA">HAPUS</a>
					  </div>';
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->alumni_model->count_all(),
			"recordsFiltered" => $this->alumni_model->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
    
    function edit_status($id)
    {
		$cek = $this->alumni_model->cek_isialumni($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            if($this->input->post('submit', TRUE) == 'Submit')
		    {
                $this->alumni_model->edit_status($id); 
            }
            $data['title'] = 'Edit Status';
            $data['data'] = $this->db->get_where('tb_isialumni',['id'=>$id])->row();
		    //layout
            $this->load->view('admin/template/head');
            $this->load->view('admin/template/topbar');
            $this->load->view('admin/template/nav');
            $this->load->view('admin/alumni/form_status', $data);
            $this->load->view('admin/template/js');
            $this->load->view('admin/alumni/script');
        }
    }

    function lihat_alumni($id)
	{ 
        $data = $this->db->get_where('tb_isialumni', ['id'=>$id])->row();
        echo json_encode($data);
    }

    function status($id)
	{ 
        $data = $this->db->select('id,status')->from('tb_isialumni')->where('id', $id)->get()->row();
        echo json_encode($data);
    }

    function save_status()
	{   
        $id = $this->input->post('id',TRUE); 
        $q = $this->alumni_model->save_status($id);
        echo json_encode($q);	
    }

    function hapus_isialumni($id)
    {
		$cek = $this->alumni_model->cek_isialumni($id); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $this->alumni_model->hapus_isialumni($id);  
        }
    }

    private function _validation()
    {
        $this->form_validation->set_error_delimiters('<div style="color:#fff; background-color:#DC143C; padding:2px;"><i class="fa fa-times-circle"></i> ', '</div>');
        $this->form_validation->set_rules('id_tahun', 'Tahun Pelajaran', 'required');
        $this->form_validation->set_rules('jml_l', 'Jumlah Laki-Laki', 'required');
        $this->form_validation->set_rules('jml_p', 'Jumlah Perempuan', 'required');
    }

}