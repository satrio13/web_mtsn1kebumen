<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download_model extends CI_Model {
 
    private $table = 'tb_download d'; //nama tabel dari database
    private $column_order = array(null,'d.nama_file','d.file','d.tgl_upload','d.hits','u.nama','d.is_active','d.id');
    private $column_search = array('d.nama_file','d.file','d.tgl_upload','d.hits','u.nama','d.is_active');
    private $order = array('d.id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('d.*,u.nama');
		$this->db->from($this->table);
        $this->db->join('tb_user u', 'd.id_user=u.id_user');
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
 
    function tambah_download()
	{
        $config['upload_path'] = 'assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|xls|xlsx|docx|ppt|rar|zip';
        //$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '7168'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['file']['name']))
        {
            if($this->upload->do_upload('file'))
            {
                $gbr = $this->upload->data();
                $data = [
                    'nama_file' => strip_tags($this->input->post('nama_file',TRUE)),
                    'id_user' => $this->session->userdata('id_user'),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                    'tgl_upload' => tgl_jam_simpan_sekarang(),
                    'hits' => 0,
                    'file'=>$gbr['file_name']
                ];
                $this->db->insert('tb_download',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-download', 'FILE BERHASIL DITAMBAHKAN');
                    redirect('backend/download');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-download', 'FILE GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-download', 'FILE GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $this->session->set_flashdata('msg-gagal-download', 'ANDA BELUM MEMILIH FILE!');
        }
    }

    function cek_download($id)
    {
        return $this->db->select('id')->from('tb_download')->where('id',$id)->get()->row();
    }

    function edit_download($id)
	{
        $get = $this->db->select('id,file')->from('tb_download')->where('id',$id)->get()->row();
        $target = "assets/file/$get->file";

        $config['upload_path'] = 'assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|xls|xlsx|docx|ppt|rar|zip';
        //$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '7168'; // kb
        $this->load->library('upload', $config);

        if(!empty($_FILES['file']['name']))
        {
            if($this->upload->do_upload('file'))
            {
                unlink($target);
                $gbr = $this->upload->data();
                $data = [
                    'nama_file' => strip_tags($this->input->post('nama_file',TRUE)),
                    'id_user' => $this->session->userdata('id_user'),
                    'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                    'tgl_upload' => tgl_jam_simpan_sekarang(),
                    'file'=>$gbr['file_name']
                ];
                $this->db->update('tb_download',$data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-download', 'FILE BERHASIL DIUPDATE');
                    redirect('backend/download');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-download', 'FILE GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-download', 'FILE GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama_file' => strip_tags($this->input->post('nama_file',TRUE)),
                'id_user' => $this->session->userdata('id_user'),
                'is_active' => strip_tags($this->input->post('is_active',TRUE)),
                'tgl_upload' => tgl_jam_simpan_sekarang()
            ];
            $this->db->update('tb_download',$data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-download', 'FILE BERHASIL DIUPDATE');
                redirect('backend/download');
            }else
            {
                $this->session->set_flashdata('msg-gagal-download', 'FILE GAGAL DIUPDATE!');
            }
        }
    }

    function hapus_download($id)
	{
        $get = $this->db->select('id,file')->from('tb_download')->where('id',$id)->get()->row();
        $target = "assets/file/$get->file";
        unlink($target);
		$this->db->delete('tb_download', array('id'=>$id));
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-download', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-download', 'DATA GAGAL DIHAPUS!');
		}
		redirect('backend/download');
	}

}