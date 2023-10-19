<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model(array('web/home_model','web/galeri_model'));
	} 

    function foto()
    {
        error_reporting(0);
		$data['titleweb'] = 'Galeri Foto- '.title();
		$data['title'] = 'Foto';
		$this->load->library('pagination');
		//konfigurasi pagination
        $config['base_url'] = site_url('galeri/foto/index'); 
        $config['total_rows'] = $this->galeri_model->tampil_album()->num_rows(); 
        $config['per_page'] = 8;  

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['data'] = $this->galeri_model->tampil_album_pagination($config["per_page"], $data['start']);           
        $data['pagination'] = $this->pagination->create_links();
		//layout
		$this->load->view('template/head', $data);
		$this->load->view('template/topbar');
		$this->load->view('galeri/foto', $data);
		$this->load->view('template/footer');
		$this->load->view('galeri/script');
    }

    function video()
    {
		$data['titleweb'] = 'Galeri Video- '.title();
		$data['title'] = 'Video';
		$this->load->library('pagination');
		//konfigurasi pagination
        $config['base_url'] = site_url('galeri/video/index'); 
        $config['total_rows'] = $this->galeri_model->tampil_video()->num_rows(); 
        $config['per_page'] = 6;  

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['data'] = $this->galeri_model->tampil_video_pagination($config["per_page"], $data['start']);           
        $data['pagination'] = $this->pagination->create_links();
		//layout
        $this->load->view('template/head', $data);
        $this->load->view('template/topbar');
        $this->load->view('galeri/video', $data);
        $this->load->view('template/footer');
        $this->load->view('galeri/script');
    }

    function album($slug)
    {
        $cek = $this->galeri_model->cek_album($slug); 
        if(!$cek)
        { 
            show_404(); 
        }else
        {
            $get = $this->db->select('slug,album')->from('tb_album')->where('slug',$slug)->get()->row();
            $data['galeri'] = $this->galeri_model->tampil_foto($slug);
            $data['titleweb'] = $get->album.' - '.title();
            $data['title'] = $get->album;
            //layout
            $this->load->view('template/head', $data);
            $this->load->view('template/topbar');
            $this->load->view('galeri/album', $data);
            $this->load->view('template/footer');
            $this->load->view('galeri/script');
        }
    }

}