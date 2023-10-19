<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model(array('web/program_model','web/home_model'));
	} 

    function index()
    {
        show_404();
    }

	function paud()
    {   
        $data['titleweb'] = 'PAUD - '.title();
        $data['title'] = 'PAUD';
        $data['data'] = $this->program_model->paud();
        $this->template->web('main','program/paud',$data);
    }

    function paket_a()
    {   
        $data['titleweb'] = 'PAKET A - '.title();
        $data['title'] = 'PAKET A';
        $data['data'] = $this->program_model->paket_a();
        $this->template->web('main','program/paket_a',$data);
    }

    function paket_b()
    {   
        $data['titleweb'] = 'PAKET B - '.title();
        $data['title'] = 'PAKET B';
        $data['data'] = $this->program_model->paket_b();
        $this->template->web('main','program/paket_b',$data);
    }

    function paket_c()
    {   
        $data['titleweb'] = 'PAKET C - '.title();
        $data['title'] = 'PAKET C';
        $data['data'] = $this->program_model->paket_c();
        $this->template->web('main','program/paket_c',$data);
    }

    function kursus()
    {   
        $data['titleweb'] = 'KURSUS - '.title();
        $data['title'] = 'KURSUS';
        $data['data'] = $this->program_model->kursus();
        $this->template->web('main','program/kursus',$data);
    }
	
}