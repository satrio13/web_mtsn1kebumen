<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Program_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function paud()
    {
        return $this->db->get_where('tb_program',['id'=>1])->row();
    }

    function paket_a()
    {
        return $this->db->get_where('tb_program',['id'=>2])->row();
    }

    function paket_b()
    {
        return $this->db->get_where('tb_program',['id'=>3])->row();
    }

    function paket_c()
    {
        return $this->db->get_where('tb_program',['id'=>4])->row();
    }

    function kursus()
    {
        return $this->db->get_where('tb_program',['id'=>5])->row();
    }

}