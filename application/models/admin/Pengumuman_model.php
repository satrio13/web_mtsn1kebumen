<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengumuman_model extends CI_Model {
 
    private $table = 'tb_pengumuman p'; //nama tabel dari database
    private $column_order = array(null,'p.nama','p.isi','p.gambar','u.nama','p.hari','p.tgl','p.dibaca','p.id');
    private $column_search = array('p.nama','p.isi','p.gambar','u.nama','p.hari','p.tgl','p.dibaca');
    private $order = array('p.id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('p.*,u.nama AS nama_operator');
		$this->db->from($this->table);
        $this->db->join('tb_user u', 'p.id_user=u.id_user');
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

    function tambah_pengumuman()
	{
        $config['upload_path'] = 'assets/img/pengumuman/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                $gbr = $this->upload->data();
                $data = [
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'isi' => $this->input->post('isi',TRUE),
                    'id_user' => $this->session->userdata('id_user'),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                    'hari' => hari_ini_indo(),
                    'tgl' => tgl_jam_simpan_sekarang(),
                    'dibaca' => 0,
                    'gambar'=>$gbr['file_name'],
                    'slug'=> slug(strip_tags($this->input->post('nama',TRUE)))
                ];
                $this->db->insert('tb_pengumuman',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-pengumuman', 'PENGUMUMAN BERHASIL DITAMBAHKAN');
                    redirect('backend/pengumuman');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-pengumuman', 'PENGUMUMAN GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-pengumuman', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'isi' => $this->input->post('isi',TRUE),
                'id_user' => $this->session->userdata('id_user'),
                'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                'hari' => hari_ini_indo(),
                'tgl' => tgl_jam_simpan_sekarang(),
                'dibaca' => 0,
                'slug'=> slug(strip_tags($this->input->post('nama',TRUE)))
            ];
            $this->db->insert('tb_pengumuman',$data);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-pengumuman', 'PENGUMUMAN BERHASIL DITAMBAHKAN');
                redirect('backend/pengumuman');
            }else
            {
                $this->session->set_flashdata('msg-gagal-pengumuman', 'PENGUMUMAN GAGAL DITAMBAHKAN!');
            }
        }
    }
 
    function cek_pengumuman($id)
    {
        return $this->db->select('id')->from('tb_pengumuman')->where('id',$id)->get()->row();
    }

    function edit_pengumuman($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_pengumuman')->where('id',$id)->get()->row();
        $target = "assets/img/pengumuman/$get->gambar";

        $config['upload_path'] = 'assets/img/pengumuman/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'isi' => $this->input->post('isi',TRUE),
                    'id_user' => $this->session->userdata('id_user'),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                    'hari' => hari_ini_indo(),
                    'tgl' => tgl_jam_simpan_sekarang(),
                    'gambar'=>$gbr['file_name'],
                    'slug'=> slug(strip_tags($this->input->post('nama',TRUE)))
                ];
                $this->db->update('tb_pengumuman',$data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-pengumuman', 'PENGUMUMAN BERHASIL DIUPDATE');
                    redirect('backend/pengumuman');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-pengumuman', 'PENGUMUMAN GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-pengumuman', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'isi' => $this->input->post('isi',TRUE),
                'id_user' => $this->session->userdata('id_user'),
                'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                'hari' => hari_ini_indo(),
                'tgl' => tgl_jam_simpan_sekarang(),
                'slug'=> slug(strip_tags($this->input->post('nama',TRUE)))
            ];
            $this->db->update('tb_pengumuman',$data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-pengumuman', 'PENGUMUMAN BERHASIL DIUPDATE');
                redirect('backend/pengumuman');
            }else
            {
                $this->session->set_flashdata('msg-gagal-pengumuman', 'PENGUMUMAN GAGAL DIUPDATE!');
            }
        }
    }

    function hapus_pengumuman($id)
	{ 
        $get = $this->db->select('id,gambar')->from('tb_pengumuman')->where('id',$id)->get()->row();
        $target = "assets/img/pengumuman/$get->gambar";
        unlink($target);
		$this->db->delete('tb_pengumuman', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-pengumuman', 'PENGUMUMAN BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-pengumuman', 'PENGUMUMAN GAGAL DIHAPUS!');
        }
        redirect('backend/pengumuman');
    }

}