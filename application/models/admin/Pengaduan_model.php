<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengaduan_model extends CI_Model {
 
    private $table = 'tb_pengaduan'; //nama tabel dari database
    private $column_order = array(null,'nama','status','isi','id');
    private $column_search = array('nama','status','isi');
    private $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
   function tampil_pengaduan()
    {
        return $this->db->select('*')->from('tb_pengaduan')->order_by('id','desc')->get();
    }
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // cek kalo ada search data
			{				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open group like or like
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close group like or like
			}
			$i++;
		}		
		if(isset($_POST['order'])) // cek kalo click order
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

    function cek_pengaduan($id)
    {
        return $this->db->select('id')->from('tb_pengaduan')->where('id',$id)->get()->row();
    }

    function hapus_pengaduan($id)
	{
		$this->db->delete('tb_pengaduan', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-pengaduan', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-pengaduan', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/pengaduan');
    }

}