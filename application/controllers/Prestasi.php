<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model(array('web/prestasi_model','web/home_model'));
	} 

    function index()
    {
        show_404();
    }

    function prestasi_siswa()
    {
        $data['titleweb'] = 'Prestasi Siswa - '.title();
        $data['title'] = 'Prestasi Siswa';
        $data['data'] = $this->prestasi_model->tampil_prestasi_siswa();
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('prestasi/prestasi_siswa', $data);
        $this->load->view('template/footer');
        $this->load->view('prestasi/script');
    }

    function prestasi_guru()
    {
        $data['titleweb'] = 'Prestasi Guru - '.title();
        $data['title'] = 'Prestasi Guru';
        $data['data'] = $this->prestasi_model->tampil_prestasi_guru();
        //layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('prestasi/prestasi_guru', $data);
        $this->load->view('template/footer');
        $this->load->view('prestasi/script');
    }
    
    function prestasi_sekolah()
    {    
        if(jenjang() == 1 OR jenjang() == 2)
        { 
            $data['titleweb'] = 'Prestasi Sekolah - '.title();
            $data['title'] = 'Prestasi Sekolah';
            $data['data'] = $this->prestasi_model->tampil_prestasi_sekolah();
            //layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('prestasi/prestasi_sekolah', $data);
            $this->load->view('template/footer');
            $this->load->view('prestasi/script');
        }else
        {
            show_404();
        }
    }

    function prestasi_madrasah()
    {
        if(jenjang() == 3 OR jenjang() == 4)
        { 
            $data['titleweb'] = 'Prestasi Madrasah - '.title();
            $data['title'] = 'Prestasi Madrasah';
            $data['data'] = $this->prestasi_model->tampil_prestasi_sekolah();
            //layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('prestasi/prestasi_madrasah', $data);
            $this->load->view('template/footer');
            $this->load->view('prestasi/script');
        }else
        {
            show_404();
        }
    }

}