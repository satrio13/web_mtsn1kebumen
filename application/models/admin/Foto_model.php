<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Foto_model extends CI_Model {
 
    private $table = 'tb_foto f'; //nama tabel dari database
    private $column_order = array(null,'f.foto','a.album','f.uploaded_on','f.id_foto');
    private $column_search = array('f.foto','a.album','f.uploaded_on');
    private $order = array('f.id_foto' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('f.*,a.album');
		$this->db->from($this->table);
        $this->db->join('tb_album a', 'f.id_album=a.id_album');
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

    function tambah_foto()
    {
        $data = array();
        if($this->input->post('submit') && !empty($_FILES['files']['name']))
        {
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++)
            {
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'assets/img/foto/';
                $config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['encrypt_name'] = TRUE; //nama yang terupload nantinya
                $config['max_size'] = '7168'; // kb
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                    // Upload file to server
                if($this->upload->do_upload('file'))
                {
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = tgl_jam_simpan_sekarang();
                        $data_input = [
							'id_album'=>$this->input->post('id_album', TRUE),
							'foto'=>$fileData['file_name'],
							'uploaded_on'=>tgl_jam_simpan_sekarang()
                        ];
                    $this->db->insert('tb_foto',$data_input);
					$this->session->set_flashdata('msg-foto', 'DATA BERHASIL DIUPLOAD');
                }else
                {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('msg-gagal-foto', 'File gagal diupload! periksa kembali format dan ukuran file anda..');
                }
            }
        }
    }

    function cek_foto($id)
    {
        return $this->db->select('id_foto')->from('tb_foto')->where('id_foto',$id)->get()->row();
    }

    function hapus_foto($id)
	{
        $get = $this->db->get_where('tb_foto', ['id_foto'=>$id])->row();
		$target = "assets/img/foto/$get->foto";
		unlink($target);
		$this->db->delete('tb_foto', array('id_foto'=>$id));
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-foto', 'FOTO BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-foto', 'FOTO GAGAL DIHAPUS!');
		}
		redirect('backend/foto');
    }

}