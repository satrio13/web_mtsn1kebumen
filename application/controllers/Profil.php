<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(array('web/profil_model','web/home_model'));
	} 

    function index()
    {
        if(jenjang() == 1 OR jenjang() == 2)
        {
            $data['titleweb'] = 'Profil Sekolah - '.title();
            $data['title'] = 'Profil Sekolah';
        }else
        {
            $data['titleweb'] = 'Profil Madrasah - '.title();
            $data['title'] = 'Profil Madrasah';
        }
        $data['data'] = $this->profil_model->tampil_profil();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/profil', $data);
		$this->load->view('template/footer');
	}

	function sejarah()
    {
        $data['titleweb'] = 'Sejarah - '.title();
        $data['title'] = 'Sejarah';
		$data['data'] = $this->profil_model->tampil_sejarah();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/sejarah', $data);
		$this->load->view('template/footer');
	}

	function visi_misi()
    {
        $data['titleweb'] = 'Visi & Misi - '.title();
        $data['title'] = 'Visi & Misi';
		$data['data'] = $this->profil_model->tampil_visi_misi();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/visi_misi', $data);
		$this->load->view('template/footer');
    }
    
    function struktur_organisasi()
    {
        $data['titleweb'] = 'Struktur Organisasi - '.title();
        $data['title'] = 'Struktur Organisasi';
		$data['data'] = $this->profil_model->tampil_struktur_organisasi();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/struktur_organisasi', $data);
		$this->load->view('template/footer');
    }
    
    function ekstrakurikuler()
    {
        $data['titleweb'] = 'Ekstrakurikuler - '.title();
        $data['title'] = 'Ekstrakurikuler';
		$data['data'] = $this->profil_model->tampil_ekstrakurikuler();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/ekstrakurikuler', $data);
		$this->load->view('template/footer');
    }

    function detail_ekstrakurikuler($slug)
    {
        $cek = $this->profil_model->cek_ekstrakurikuler($slug); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $get = $this->db->get_where('tb_ekstrakurikuler',['slug'=>$slug])->row();
			$data['titleweb'] = $get->nama_ekstrakurikuler.' - '.title();
			$data['title'] = $get->nama_ekstrakurikuler;
			$data['data'] = $get;
            $data['berita_terpopuler'] = $this->home_model->berita_terpopuler();
            $data['link_terkait'] = $this->home_model->tampil_link();
			//layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('profil/detail_ekstrakurikuler', $data);
            $this->load->view('template/footer');
            $this->load->view('profil/script');
        }
    }

    function sarpras()
    {
        $data['titleweb'] = 'Sarana & Prasarana - '.title();
        $data['title'] = 'Sarana & Prasarana';
		$data['data'] = $this->profil_model->tampil_sarpras();
        //layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('profil/sarpras', $data);
		$this->load->view('template/footer');
    }

}