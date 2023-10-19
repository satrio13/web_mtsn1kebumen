<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

	function __construct(){
		parent::__construct();
    $this->load->model(array('web/berita_model','web/home_model'));
	} 

  function index()
  {
		$data['titleweb'] = 'Berita - '.title();
		$data['title'] = 'Berita';
		$this->load->library('pagination');
		//konfigurasi pagination
    $config['base_url'] = site_url('berita/index'); 
    $config['total_rows'] = $this->berita_model->tampil_berita()->num_rows(); 
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
    if($this->uri->segment(3) > 0)
    {
      $data['start'] = $this->uri->segment(3);
    }else
    {
      $data['start'] = 0;
    }
    $data['data'] = $this->berita_model->tampil_berita_pagination($config["per_page"], $data['start']);           
    $data['pagination'] = $this->pagination->create_links();
    $data['cari'] = '';
    //layout
    $this->load->view('template/head', $data);
    $this->load->view('template/topbar');
    $this->load->view('berita/berita', $data);
    $this->load->view('template/footer');
  }

  function search()
  {
		$data['titleweb'] = 'Berita - '.title();
		$data['title'] = 'Berita';
		$this->load->library('pagination');
		//konfigurasi pagination
    if(empty($this->uri->segment(3)))
    {
      $data['cari'] = $this->input->get('q');
    }else
    {
      $data['cari'] = $this->uri->segment(3);
    }
    $config['base_url'] = site_url('berita/search/'.$data['cari'].''); 
    $config['total_rows'] = $this->berita_model->tampil_berita_cari($data['cari'])->num_rows(); 
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
    if($this->uri->segment(4) > 0)
		{
			$data['start'] = $this->uri->segment(4);
		}else
		{
			$data['start'] = 0;
		}
    $data['data'] = $this->berita_model->tampil_berita_pagination_cari($config["per_page"], $data['start'], $data['cari']);           
    $data['pagination'] = $this->pagination->create_links();
    //layout
    $this->load->view('template/head', $data);
    $this->load->view('template/topbar');
    $this->load->view('berita/berita', $data);
    $this->load->view('template/footer');
  }

	function detail($slug)
  {   
		$cek = $this->berita_model->cek_berita($slug); 
    if(!$cek)
    { 
      show_404(); 
    }else
    {
      $get = $this->db->get_where('tb_berita',['slug'=>$slug])->row();
      $this->db->update('tb_berita', ['dibaca'=>$get->dibaca+1], ['slug'=>$get->slug]);
      $data['titleweb'] = $get->nama.' - '.title();
      $data['title'] = $get->nama;
      $data['data'] = $get;
      $data['berita_terpopuler'] = $this->home_model->berita_terpopuler($slug);
      $data['link_terkait'] = $this->home_model->tampil_link();
      //layout
      $this->load->view('template/head', $data);
      $this->load->view('template/topbar');
      $this->load->view('berita/detail_berita', $data);
      $this->load->view('template/footer');
      $this->load->view('berita/script');
		}
	}
	
}