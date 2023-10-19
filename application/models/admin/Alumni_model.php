<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Alumni_model extends CI_Model {
 
    private $table = 'tb_isialumni'; //nama tabel dari database
    private $column_order = array(null, 'status','nama','th_lulus','alamat','kesan','gambar','tglpost','id'); 
    private $column_search = array('status','nama','th_lulus','alamat','kesan','gambar','tglpost'); 
    private $order = array('id' => 'desc'); // default order 
 
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

    function tampil_alumni()
    {
        return $this->db->select('a.*,t.tahun')->from('tb_alumni a')->join('tb_tahun t','a.id_tahun=t.id_tahun')->order_by('id','desc')->get();
    }

    function tambah_alumni()
	{
        $data = [
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
            'jml_l' => strip_tags($this->input->post('jml_l',TRUE)),
            'jml_p' => strip_tags($this->input->post('jml_p',TRUE))
        ];

        $this->db->insert('tb_alumni',$data);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-alumni', 'DATA BERHASIL DITAMBAHKAN');
            redirect('backend/alumni');
        }else
        {
            $this->session->set_flashdata('msg-gagal-alumni', 'DATA GAGAL DITAMBAHKAN!');
        }
    }

    function cek_alumni($id)
    {
        return $this->db->select('id')->from('tb_alumni')->where('id',$id)->get()->row();
    }

    function cek_isialumni($id)
    {
        return $this->db->select('id')->from('tb_isialumni')->where('id',$id)->get()->row();
    }

    function edit_alumni($id)
	{
        $data = [
            'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
            'jml_l' => strip_tags($this->input->post('jml_l',TRUE)),
            'jml_p' => strip_tags($this->input->post('jml_p',TRUE))
        ];

        $this->db->update('tb_alumni',$data,['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-alumni', 'DATA BERHASIL DIUPDATE');
            redirect('backend/alumni');
        }else
        {
            $this->session->set_flashdata('msg-gagal-alumni', 'DATA GAGAL DIUPDATE!');
        }
    }

    function hapus_alumni($id)
	{
        $this->db->delete('tb_alumni', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-alumni', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-alumni', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/alumni');
    }

    function edit_status($id)
    {
        $data_update = [
            'status' => strip_tags($this->input->post('status',TRUE))
        ];

        $this->db->update('tb_isialumni',$data_update, ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-isialumni', 'DATA BERHASIL DIUPDATE');
            redirect('backend/penelusuran-alumni');
        }else
        {
            $this->session->set_flashdata('msg-gagal-isialumni', 'DATA GAGAL DIUPDATE!');
        }	
    }

    function save_status($id)
    {
        $data = [
            'status' => strip_tags($this->input->post('status',TRUE))
        ];

        $this->db->update('tb_isialumni', $data, ['id'=>$id]);
        return $this->db->affected_rows();
    }

    function hapus_isialumni($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_isialumni')->where('id',$id)->get()->row();
		$target = "assets/img/alumni/$get->gambar";
		unlink($target);
        $this->db->delete('tb_isialumni', array('id'=>$id));
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-isialumni', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-isialumni', 'DATA GAGAL DIHAPUS!');
        }
		redirect('backend/penelusuran-alumni');
    }

}