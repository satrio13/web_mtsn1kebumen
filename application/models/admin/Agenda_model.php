<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda_model extends CI_Model {
 
    private $table = 'tb_agenda'; //nama tabel dari database
    private $column_order = array(null, 'nama_agenda','keterangan','tgl','tgl_mulai','tgl_selesai','jam_mulai','jam_selesai','tempat','gambar'); //field yang ada di table
    private $column_search = array('nama_agenda','keterangan','tgl','tgl_mulai','tgl_selesai','jam_mulai','jam_selesai','tempat','gambar'); //field yang diizin untuk pencarian 
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
    
    function tambah_agenda()
	{
        $config['upload_path'] = 'assets/img/agenda/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
        $config['max_size'] = '1024'; // kb
        $this->load->library('upload', $config);
        if(!empty($_FILES['gambar']['name']))
        {
            if($this->upload->do_upload('gambar'))
            {
                $gbr = $this->upload->data();
                if(strip_tags($this->input->post('berapa_hari',TRUE)) == 1)
                {
                    $data = [
                        'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                        'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                        'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                        'tgl' => strip_tags($this->input->post('tgl',TRUE)),
                        'tgl_mulai' => '',
                        'tgl_selesai' => '',
                        'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                        'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                        'gambar'=> $gbr['file_name'],
                        'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                    ];
                }else
                {
                    $data = [
                        'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                        'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                        'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                        'tgl' => '',
                        'tgl_mulai' => strip_tags($this->input->post('tgl_mulai',TRUE)),
                        'tgl_selesai' => strip_tags($this->input->post('tgl_selesai',TRUE)),
                        'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                        'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                        'gambar'=>$gbr['file_name'],
                        'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                    ];
                }
                $this->db->insert('tb_agenda',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-agenda', 'AGENDA BERHASIL DITAMBAHKAN');
                    redirect('backend/agenda');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-agenda', 'AGENDA GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-agenda', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            if(strip_tags($this->input->post('berapa_hari',TRUE)) == 1)
            {
                $data = [
                    'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                    'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                    'tgl' => strip_tags($this->input->post('tgl',TRUE)),
                    'tgl_mulai' => '',
                    'tgl_selesai' => '',
                    'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                    'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                    'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                ];
            }else
            {
                $data = [
                    'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                    'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                    'tgl' => '',
                    'tgl_mulai' => strip_tags($this->input->post('tgl_mulai',TRUE)),
                    'tgl_selesai' => strip_tags($this->input->post('tgl_selesai',TRUE)),
                    'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                    'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                    'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                ];
            }
            $this->db->insert('tb_agenda',$data);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-agenda', 'AGENDA BERHASIL DITAMBAHKAN');
                redirect('backend/agenda');
            }else
            {
                $this->session->set_flashdata('msg-gagal-agenda', 'AGENDA GAGAL DITAMBAHKAN!');
            }
        }
    }

    function cek_agenda($id)
    {
        return $this->db->select('id')->from('tb_agenda')->where('id',$id)->get()->row();
    }

    function edit_agenda($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_agenda')->where('id',$id)->get()->row();
        $target = "assets/img/agenda/$get->gambar";

        $config['upload_path'] = 'assets/img/agenda/';
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
                if(strip_tags($this->input->post('berapa_hari',TRUE)) == 1)
                {
                    $data = [
                        'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                        'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                        'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                        'tgl' => strip_tags($this->input->post('tgl',TRUE)),
                        'tgl_mulai' => '',
                        'tgl_selesai' => '',
                        'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                        'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                        'gambar'=>$gbr['file_name'],
                        'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                    ];
                }else
                {
                    $data = [
                        'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                        'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                        'keterangan' => $this->input->post('keterangan',TRUE),
                        'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                        'tgl' => '',
                        'tgl_mulai' => strip_tags($this->input->post('tgl_mulai',TRUE)),
                        'tgl_selesai' => strip_tags($this->input->post('tgl_selesai',TRUE)),
                        'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                        'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                        'gambar'=>$gbr['file_name'],
                        'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                    ];
                }
                $this->db->update('tb_agenda', $data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-agenda', 'AGENDA BERHASIL DIUPDATE');
                    redirect('backend/agenda');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-agenda', 'AGENDA GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-agenda', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            if(strip_tags($this->input->post('berapa_hari',TRUE)) == 1)
            {
                $data = [
                    'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                    'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                    'tgl' => strip_tags($this->input->post('tgl',TRUE)),
                    'tgl_mulai' => '',
                    'tgl_selesai' => '',
                    'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                    'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                    'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                ];
            }else
            {	
                $data = [
                    'nama_agenda' => strip_tags($this->input->post('nama_agenda',TRUE)),
                    'berapa_hari' => strip_tags($this->input->post('berapa_hari',TRUE)),
                    'keterangan' => $this->input->post('keterangan',TRUE),
                    'tempat' => strip_tags($this->input->post('tempat',TRUE)),
                    'tgl' => '',
                    'tgl_mulai' => strip_tags($this->input->post('tgl_mulai',TRUE)),
                    'tgl_selesai' => strip_tags($this->input->post('tgl_selesai',TRUE)),
                    'jam_mulai' => strip_tags($this->input->post('jam_mulai',TRUE)),
                    'jam_selesai' => strip_tags($this->input->post('jam_selesai',TRUE)),
                    'slug'=> slug(strip_tags($this->input->post('nama_agenda',TRUE)))
                ];
            }
            $this->db->update('tb_agenda', $data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-agenda', 'AGENDA BERHASIL DIUPDATE');
                redirect('backend/agenda');
            }else
            {
                $this->session->set_flashdata('msg-gagal-agenda', 'AGENDA GAGAL DIUPDATE!');
            }
        }
    }
    
    function hapus_agenda($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_agenda')->where('id',$id)->get()->row();
        $target = "assets/img/agenda/$get->gambar";
        unlink($target);
		$this->db->delete('tb_agenda', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-agenda', 'AGENDA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-agenda', 'AGENDA GAGAL DIHAPUS!');
        }
        redirect('backend/agenda');
    }

}