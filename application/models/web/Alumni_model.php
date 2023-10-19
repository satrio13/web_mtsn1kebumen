<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alumni_model extends CI_Model {
 
    private $table = 'tb_isialumni'; //nama tabel dari database
    private $column_order = array(null, 'nama','th_lulus','sma','pt','instansi','alamatins','hp','email','alamat','kesan','gambar');
    private $column_search = array('nama','th_lulus','sma','pt','instansi','alamatins','hp','email','alamat','kesan'); 
    private $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->where('status',1);
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function tampil_alumni()
    {
        return $this->db->select('a.*,t.tahun')->from('tb_alumni a')->join('tb_tahun t','a.id_tahun=t.id_tahun')->order_by('t.tahun','desc')->get();
    }

    function tampil_isialumni()
    {
        return $this->db->select('*')->from('tb_isialumni')->where('status',1)->order_by('id','desc')->get();
    }

    function tampil_isialumni_pagination($limit, $start)
    {
        return $this->db->select('*')->from('tb_isialumni')->where('status',1)->order_by('id','desc')->limit($limit,$start)->get();
    }

    function isi_alumni()
    {
        $secutity_code = $this->input->post('secutity_code');
        $mycaptcha = $this->session->userdata('mycaptcha');
        if($secutity_code == $mycaptcha)
        {
            date_default_timezone_set('Asia/Jakarta');
            $waktu = date('Y-m-d H:i:s');
    
            $config['upload_path'] = 'assets/img/alumni/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
            $config['max_size'] = '1024'; // kb
            $this->load->library('upload', $config);

            if(!empty($_FILES['gambar']['name']))
            {
                if($this->upload->do_upload('gambar'))
                {
                    $gbr = $this->upload->data();
                    $data_insert = array(
                        'nama' => strip_tags($this->input->post('nama',TRUE)),
                        'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                        'sma' => strip_tags($this->input->post('sma',TRUE)),
                        'pt' => strip_tags($this->input->post('pt',TRUE)),
                        'instansi' => strip_tags($this->input->post('instansi',TRUE)),
                        'alamatins' => strip_tags($this->input->post('alamatins',TRUE)),
                        'hp' => strip_tags($this->input->post('hp',TRUE)),
                        'email' => strip_tags($this->input->post('email',TRUE)),
                        'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                        'kesan' => strip_tags($this->input->post('kesan',TRUE)),
                        'tglpost' => $waktu,
                        'status' => 0,
                        'gambar'=>$gbr['file_name']
                    );
                    $this->db->insert('tb_isialumni',$data_insert);
                    $this->session->set_flashdata('msg-alumni', 'DATA BERHASIL DIKIRIM');
                    redirect('alumni/penelusuran-alumni');
                }else{
                    $this->session->set_flashdata('msg-gagal-alumni', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
                }
            }else{
                $data_insert = array(
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                    'sma' => strip_tags($this->input->post('sma',TRUE)),
                    'pt' => strip_tags($this->input->post('pt',TRUE)),
                    'instansi' => strip_tags($this->input->post('instansi',TRUE)),
                    'alamatins' => strip_tags($this->input->post('alamatins',TRUE)),
                    'hp' => strip_tags($this->input->post('hp',TRUE)),
                    'email' => strip_tags($this->input->post('email',TRUE)),
                    'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                    'kesan' => strip_tags($this->input->post('kesan',TRUE)),
                    'tglpost' => $waktu,
                    'status' => 0
                );
                $this->db->insert('tb_isialumni',$data_insert);
                $this->session->set_flashdata('msg-alumni', 'DATA BERHASIL DIKIRIM');
                redirect('alumni/penelusuran-alumni');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-alumni', 'Captcha salah');
        }
    }

}