<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('web/pendidikan_model','web/home_model'));
    }
    
    function index()
    {
        show_404();
    }

    function kurikulum()
    {
        $data['titleweb'] = 'Kurikulum - '.title();
        $data['title'] = 'Kurikulum';
        $data['kelompok_a'] = $this->pendidikan_model->tampil_kurikulum_a();
        $data['kelompok_b'] = $this->pendidikan_model->tampil_kurikulum_b();
        $data['kelompok_c'] = $this->pendidikan_model->tampil_kurikulum_c();
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('pendidikan/kurikulum', $data);
        $this->load->view('template/footer');
    }

    function kalender()
    {
        $data['titleweb'] = 'Kalender Akademik - '.title();
        $data['title'] = 'Kalender Akademik';
        $data['data'] = $this->pendidikan_model->kalender();
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('pendidikan/kalender', $data);
        $this->load->view('template/footer');
    }

    function rekap_us()
    {
        if($this->input->post('submit', TRUE) == 'Submit')
	    {
            $data['data'] = $this->pendidikan_model->cari_rekap_us();
        }
        
        if(jenjang() == 1 OR jenjang() == 2)
        { 
            $jenis = 'Sekolah';
        }else
        {
            $jenis = 'Madrasah';
        }
        
        $data['titleweb'] = "Rekap Ujian $jenis - ".title();
        $data['title'] = "Rekap Ujian $jenis";
        $data['tahun'] = $this->db->select('*')->from('tb_tahun')->order_by('tahun','desc')->get();
        $data['submit'] = $this->input->post('submit', TRUE);
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('pendidikan/rekap_us', $data);
        $this->load->view('template/footer');
    }

}