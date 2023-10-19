<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prestasi_sekolah_model extends CI_Model {
 
    private $table = 'tb_prestasi_sekolah p'; //nama tabel dari database
    private $column_order = array(null,'t.tahun','p.nama','p.jenis','p.prestasi','p.tingkat','p.tingkat','p.tingkat','p.tingkat','p.tingkat','p.keterangan','p.gambar','p.id');
    private $column_search = array('t.tahun','p.nama','p.jenis','p.prestasi','p.tingkat','p.keterangan','p.gambar');
    private $order = array('p.id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('p.*,t.tahun');
		$this->db->from($this->table);
        $this->db->join('tb_tahun t', 'p.id_tahun=t.id_tahun');
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
 
    function tambah_prestasi_sekolah()
	{
        $config['upload_path'] = 'assets/img/prestasi/sekolah/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);
        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                $gbr = $this->upload->data();
                $data_insert = [
                    'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'prestasi' => strip_tags($this->input->post('prestasi',TRUE)),
                    'tingkat' => strip_tags($this->input->post('tingkat',TRUE)),
                    'jenis' => strip_tags($this->input->post('jenis',TRUE)),
                    'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
                    'gambar'=>$gbr['file_name']
                ];
                $this->db->insert('tb_prestasi_sekolah',$data_insert);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-prestasi', 'PRESTASI BERHASIL DITAMBAHKAN');
                    redirect('backend/prestasi-sekolah');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-prestasi', 'PRESTASI GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-prestasi', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data_insert = [
                'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'prestasi' => strip_tags($this->input->post('prestasi',TRUE)),
                'tingkat' => strip_tags($this->input->post('tingkat',TRUE)),
                'jenis' => strip_tags($this->input->post('jenis',TRUE)),
                'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
            ];
            $this->db->insert('tb_prestasi_sekolah',$data_insert);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-prestasi', 'PRESTASI BERHASIL DITAMBAHKAN');
                redirect('backend/prestasi-sekolah');
            }else
            {
                $this->session->set_flashdata('msg-gagal-prestasi', 'PRESTASI GAGAL DITAMBAHKAN!');
            }
        }
    }

    function cek_prestasi_sekolah($id)
    {
        return $this->db->select('id')->from('tb_prestasi_sekolah')->where('id',$id)->get()->row();
    }

    function edit_prestasi_sekolah($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_prestasi_sekolah')->where('id',$id)->get()->row();
        $target = "assets/img/prestasi/sekolah/$get->gambar";
    
        $config['upload_path'] = 'assets/img/prestasi/sekolah/';
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
                $data_update = [
                    'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'prestasi' => strip_tags($this->input->post('prestasi',TRUE)),
                    'tingkat' => strip_tags($this->input->post('tingkat',TRUE)),
                    'jenis' => strip_tags($this->input->post('jenis',TRUE)),
                    'keterangan' => strip_tags($this->input->post('keterangan',TRUE)),
                    'gambar'=>$gbr['file_name']
                ];
                $this->db->update('tb_prestasi_sekolah',$data_update, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-prestasi', 'PRESTASI BERHASIL DIUPDATE');
                    redirect('backend/prestasi-sekolah');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-prestasi', 'PRESTASI GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-prestasi', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data_update = [
                'id_tahun' => strip_tags($this->input->post('id_tahun',TRUE)),
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'prestasi' => strip_tags($this->input->post('prestasi',TRUE)),
                'tingkat' => strip_tags($this->input->post('tingkat',TRUE)),
                'jenis' => strip_tags($this->input->post('jenis',TRUE)),
                'keterangan' => strip_tags($this->input->post('keterangan',TRUE))
            ];
            $this->db->update('tb_prestasi_sekolah',$data_update, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-prestasi', 'PRESTASI BERHASIL DIUPDATE');
                redirect('backend/prestasi-sekolah');
            }else
            {
                $this->session->set_flashdata('msg-gagal-prestasi', 'PRESTASI GAGAL DIUPDATE!');
            }
        }
    }

    function hapus_prestasi_sekolah($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_prestasi_sekolah')->where('id',$id)->get()->row();
        $target = "assets/img/prestasi/sekolah/$get->gambar";
		unlink($target);
		$this->db->delete('tb_prestasi_sekolah', array('id'=>$id));
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-prestasi', 'PRESTASI BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-prestasi', 'PRESTASI GAGAL DIHAPUS!');
		}
		redirect('backend/prestasi-sekolah');
    }   

}