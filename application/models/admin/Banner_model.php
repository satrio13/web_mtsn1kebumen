<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banner_model extends CI_Model {
 
    private $table = 'tb_banner'; //nama tabel dari database
    private $column_order = array(null,'gambar','judul','keterangan','link','button','is_active','id');
    private $column_search = array('gambar','judul','keterangan','link','button','is_active');
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

    function tambah_banner()
    {
        $config['upload_path'] = 'assets/img/banner/';
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
                    'gambar' => $gbr['file_name'],
                    'judul' => strip_tags($this->input->post('judul',TRUE)),
                    'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
                    'link' => strip_tags($this->input->post('link',TRUE)),
                    'button' => strip_tags($this->input->post('button',TRUE)),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE))
                ];
                $this->db->insert('tb_banner',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-banner', 'BANNER BERHASIL DITAMBAHKAN');
                    redirect('backend/banner');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-banner', 'BANNER GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-banner', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }
    }

    function cek_banner($id)
    {
        return $this->db->select('id')->from('tb_banner')->where('id',$id)->get()->row();
    }

    function edit_banner($id)
    {
        $get = $this->db->select('id,gambar')->from('tb_banner')->where('id',$id)->get()->row();
        $target = "assets/img/banner/$get->gambar";

        $config['upload_path'] = 'assets/img/banner/';
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
                    'gambar' => $gbr['file_name'],
                    'judul' => strip_tags($this->input->post('judul',TRUE)),
                    'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
                    'link' => strip_tags($this->input->post('link',TRUE)),
                    'button' => strip_tags($this->input->post('button',TRUE)),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE))
                ];
                $this->db->update('tb_banner',$data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-banner', 'BANNER BERHASIL DIUPDATE');
                    redirect('backend/banner');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-banner', 'BANNER GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-banner', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'judul' => strip_tags($this->input->post('judul',TRUE)),
                'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
                'link' => strip_tags($this->input->post('link',TRUE)),
                'button' => strip_tags($this->input->post('button',TRUE)),
                'is_active' => strip_tags($this->input->post('is_active',TRUE))
            ];
            $this->db->update('tb_banner',$data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-banner', 'BANNER BERHASIL DIUPDATE');
                redirect('backend/banner');
            }else
            {
                $this->session->set_flashdata('msg-gagal-banner', 'BANNER GAGAL DIUPDATE!');
            } 
        }
    }

    function hapus_banner($id)
    {
		$get = $this->db->select('id,gambar')->from('tb_banner')->where('id',$id)->get()->row();
		$target = "assets/img/banner/$get->gambar";
		unlink($target);
		$this->db->delete('tb_banner', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-banner', 'BANNER BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-banner', 'BANNER GAGAL DIHAPUS!');
        }
        redirect('backend/banner');
    }
 
}