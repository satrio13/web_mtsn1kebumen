<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Us_model extends CI_Model {
 
    private $table = 'tb_rekap_us u'; //nama tabel dari database
    private $column_order = array(null,'t.tahun','k.mapel','u.tertinggi','u.terendah','u.rata','u.id_us');
    private $column_search = array('t.tahun','k.mapel','u.tertinggi','u.terendah','u.rata');
    private $order = array('u.id_us' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('u.*,k.mapel,k.is_active,t.tahun');
		$this->db->from($this->table);
        $this->db->join('tb_kurikulum k', 'u.id_kurikulum=k.id_kurikulum');
        $this->db->join('tb_tahun t', 'u.id_tahun=t.id_tahun');
        $this->db->where('k.is_active',1);
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

    function tambah_rekap_us()
    {
        $data = [
            'id_kurikulum' => strip_tags($this->input->post('id_kurikulum',TRUE)),
            'tertinggi' => strip_tags($this->input->post('tertinggi',TRUE)),
            'terendah' => strip_tags($this->input->post('terendah',TRUE)),
            'rata' => strip_tags($this->input->post('rata',TRUE)),
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE))
        ];

        $this->db->insert('tb_rekap_us',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-us', 'DATA BERHASIL DITAMBAHKAN');
            redirect('backend/rekap-us');
        }else
        {
            $this->session->set_flashdata('msg-gagal-us', 'DATA GAGAL DITAMBAHKAN!');
        }
    }

    function cek_us($id)
    {
        return $this->db->select('id_us')->from('tb_rekap_us')->where('id_us',$id)->get()->row();
    }

    function edit_rekap_us($id)
    {
        $data = [
            'id_kurikulum' => strip_tags($this->input->post('id_kurikulum',TRUE)),
            'tertinggi' => strip_tags($this->input->post('tertinggi',TRUE)),
            'terendah' => strip_tags($this->input->post('terendah',TRUE)),
            'rata' => strip_tags($this->input->post('rata',TRUE)),
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE))
        ];

        $this->db->update('tb_rekap_us',$data,['id_us'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-us', 'DATA BERHASIL DIUPDATE');
            redirect('backend/rekap-us');
        }else
        {
            $this->session->set_flashdata('msg-gagal-us', 'DATA GAGAL DIUPDATE!');
        }
    }

    function hapus_rekap_us($id)
	{
        $this->db->delete('tb_rekap_us', ['id_us'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-us', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-us', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/rekap-us');
    }
 
}