<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Video_model extends CI_Model {
 
    private $table = 'tb_video'; //nama tabel dari database
    private $column_order = array(null, 'link','judul','keterangan','uploaded_on','id_video'); //field yang ada di table
    private $column_search = array('link','judul','keterangan','uploaded_on'); //field yang diizin untuk pencarian 
    private $order = array('id_video' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
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

    function tambah_video()
	{
        $data = [
            'judul' => strip_tags($this->input->post('judul',TRUE)),
            'keterangan' => $this->input->post('keterangan',TRUE),
            'link' => strip_tags($this->input->post('link',TRUE)),
            'uploaded_on' => tgl_jam_simpan_sekarang(),
        ];

        $this->db->insert('tb_video',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-video', 'VIDEO BERHASIL DITAMBAHKAN');
            redirect('backend/video');
        }else
        {
            $this->session->set_flashdata('msg-gagal-video', 'VIDEO GAGAL DITAMBAHKAN!');
        }
    }
 
    function cek_video($id)
    {
        return $this->db->select('id_video')->from('tb_video')->where('id_video',$id)->get()->row();
    }

    function edit_video($id)
	{
        $data = [
            'judul' => strip_tags($this->input->post('judul',TRUE)),
            'keterangan' => $this->input->post('keterangan',TRUE),
            'link' => strip_tags($this->input->post('link',TRUE)),
            'uploaded_on' => tgl_jam_simpan_sekarang(),
        ];

        $this->db->update('tb_video', $data, ['id_video'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-video', 'VIDEO BERHASIL DIUPDATE');
            redirect('backend/video');
        }else
        {
            $this->session->set_flashdata('msg-gagal-video', 'VIDEO GAGAL DIUPDATE!');
        }
    }

    function hapus_video($id)
	{
        $this->db->delete('tb_video', ['id_video'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-video', 'VIDEO BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-video', 'VIDEO GAGAL DIHAPUS!');
        }
        redirect('backend/video');
    }
    
}