<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Guru_model extends CI_Model {
 
    private $table = 'tb_guru'; //nama tabel dari database
    private $column_order = array(null, 'nama','nip','jk','statuspeg','statusguru','status','gambar','id'); //field yang ada di table
    private $column_search = array('nama','nip','jk','statuspeg','statusguru','status'); //field yang diizin untuk pencarian 
    private $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('id,nama,nip,jk,statuspeg,statusguru,status,gambar');
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

    function tambah_guru()
	{
        $config['upload_path'] = 'assets/img/guru/';
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
                    'nip' => strip_tags($this->input->post('nip',TRUE)),
                    'duk' => strip_tags($this->input->post('duk',TRUE)),
                    'niplama' => strip_tags($this->input->post('niplama',TRUE)),
                    'nuptk' => strip_tags($this->input->post('nuptk',TRUE)),
                    'nokarpeg' => strip_tags($this->input->post('nokarpeg',TRUE)),
                    'golruang' => strip_tags($this->input->post('golruang',TRUE)),
                    'statuspeg' => strip_tags($this->input->post('statuspeg',TRUE)),
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'tmp_lahir' => strip_tags($this->input->post('tmp_lahir',TRUE)),
                    'tgl_lahir' => strip_tags($this->input->post('tgl_lahir',TRUE)),
                    'tmt_cpns' => strip_tags($this->input->post('tmt_cpns',TRUE)),
                    'tmt_pns' => strip_tags($this->input->post('tmt_pns',TRUE)),
                    'jk' => strip_tags($this->input->post('jk',TRUE)),
                    'agama' => strip_tags($this->input->post('agama',TRUE)),
                    'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                    'pt' => strip_tags($this->input->post('pt',TRUE)),
                    'tingkat_pt' => strip_tags($this->input->post('tingkat_pt',TRUE)),
                    'prodi' => strip_tags($this->input->post('prodi',TRUE)),
                    'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                    'status' => strip_tags($this->input->post('status',TRUE)),
                    'email' => strip_tags($this->input->post('email',TRUE)),
                    'statusguru' => strip_tags($this->input->post('statusguru',TRUE)),
                    'gambar'=>$gbr['file_name']
                ];
                $this->db->insert('tb_guru',$data);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-guru', 'DATA BERHASIL DITAMBAHKAN');
                    redirect('backend/guru');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-guru', 'DATA GAGAL DITAMBAHKAN!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-guru', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'nip' => strip_tags($this->input->post('nip',TRUE)),
                'duk' => strip_tags($this->input->post('duk',TRUE)),
                'niplama' => strip_tags($this->input->post('niplama',TRUE)),
                'nuptk' => strip_tags($this->input->post('nuptk',TRUE)),
                'nokarpeg' => strip_tags($this->input->post('nokarpeg',TRUE)),
                'golruang' => strip_tags($this->input->post('golruang',TRUE)),
                'statuspeg' => strip_tags($this->input->post('statuspeg',TRUE)),
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'tmp_lahir' => strip_tags($this->input->post('tmp_lahir',TRUE)),
                'tgl_lahir' => strip_tags($this->input->post('tgl_lahir',TRUE)),
                'tmt_cpns' => strip_tags($this->input->post('tmt_cpns',TRUE)),
                'tmt_pns' => strip_tags($this->input->post('tmt_pns',TRUE)),
                'jk' => strip_tags($this->input->post('jk',TRUE)),
                'agama' => strip_tags($this->input->post('agama',TRUE)),
                'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                'pt' => strip_tags($this->input->post('pt',TRUE)),
                'tingkat_pt' => strip_tags($this->input->post('tingkat_pt',TRUE)),
                'prodi' => strip_tags($this->input->post('prodi',TRUE)),
                'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                'status' => strip_tags($this->input->post('status',TRUE)),
                'email' => strip_tags($this->input->post('email',TRUE)),
                'statusguru' => strip_tags($this->input->post('statusguru',TRUE)),
            ];
            $this->db->insert('tb_guru',$data);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-guru', 'DATA BERHASIL DITAMBAHKAN');
                redirect('backend/guru');
            }else
            {
                $this->session->set_flashdata('msg-gagal-guru', 'DATA GAGAL DITAMBAHKAN!');
            }
        }
    }

    function cek_guru($id)
    {
        return $this->db->select('id')->from('tb_guru')->where('id',$id)->get()->row();
    }

    function edit_guru($id)
	{
        $get = $this->db->select('id,gambar')->from('tb_guru')->where('id',$id)->get()->row();
        $target = "assets/img/guru/$get->gambar";
    
        $config['upload_path'] = 'assets/img/guru/';
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
                    'nip' => strip_tags($this->input->post('nip',TRUE)),
                    'duk' => strip_tags($this->input->post('duk',TRUE)),
                    'niplama' => strip_tags($this->input->post('niplama',TRUE)),
                    'nuptk' => strip_tags($this->input->post('nuptk',TRUE)),
                    'nokarpeg' => strip_tags($this->input->post('nokarpeg',TRUE)),
                    'golruang' => strip_tags($this->input->post('golruang',TRUE)),
                    'statuspeg' => strip_tags($this->input->post('statuspeg',TRUE)),
                    'nama' => strip_tags($this->input->post('nama',TRUE)),
                    'tmp_lahir' => strip_tags($this->input->post('tmp_lahir',TRUE)),
                    'tgl_lahir' => strip_tags($this->input->post('tgl_lahir',TRUE)),
                    'tmt_cpns' => strip_tags($this->input->post('tmt_cpns',TRUE)),
                    'tmt_pns' => strip_tags($this->input->post('tmt_pns',TRUE)),
                    'jk' => strip_tags($this->input->post('jk',TRUE)),
                    'agama' => strip_tags($this->input->post('agama',TRUE)),
                    'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                    'pt' => strip_tags($this->input->post('pt',TRUE)),
                    'tingkat_pt' => strip_tags($this->input->post('tingkat_pt',TRUE)),
                    'prodi' => strip_tags($this->input->post('prodi',TRUE)),
                    'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                    'status' => strip_tags($this->input->post('status',TRUE)),
                    'email' => strip_tags($this->input->post('email',TRUE)),
                    'statusguru' => strip_tags($this->input->post('statusguru',TRUE)),
                    'gambar'=>$gbr['file_name']
                ];
                $this->db->update('tb_guru',$data, ['id'=>$id]);
                if($this->db->affected_rows() > 0)
                {
                    $this->session->set_flashdata('msg-guru', 'DATA BERHASIL DIUPDATE');
                    redirect('backend/guru');
                }else
                {
                    $this->session->set_flashdata('msg-gagal-guru', 'DATA GAGAL DIUPDATE!');
                }
            }else
            {
                $this->session->set_flashdata('msg-gagal-guru', 'FOTO GAGAL DIUPLOAD! PERIKSA KEMBALI FORMAT DAN UKURAN FILE ANDA!');
            }
        }else
        {
            $data = [
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'nip' => strip_tags($this->input->post('nip',TRUE)),
                'duk' => strip_tags($this->input->post('duk',TRUE)),
                'niplama' => strip_tags($this->input->post('niplama',TRUE)),
                'nuptk' => strip_tags($this->input->post('nuptk',TRUE)),
                'nokarpeg' => strip_tags($this->input->post('nokarpeg',TRUE)),
                'golruang' => strip_tags($this->input->post('golruang',TRUE)),
                'statuspeg' => strip_tags($this->input->post('statuspeg',TRUE)),
                'nama' => strip_tags($this->input->post('nama',TRUE)),
                'tmp_lahir' => strip_tags($this->input->post('tmp_lahir',TRUE)),
                'tgl_lahir' => strip_tags($this->input->post('tgl_lahir',TRUE)),
                'tmt_cpns' => strip_tags($this->input->post('tmt_cpns',TRUE)),
                'tmt_pns' => strip_tags($this->input->post('tmt_pns',TRUE)),
                'jk' => strip_tags($this->input->post('jk',TRUE)),
                'agama' => strip_tags($this->input->post('agama',TRUE)),
                'alamat' => strip_tags($this->input->post('alamat',TRUE)),
                'pt' => strip_tags($this->input->post('pt',TRUE)),
                'tingkat_pt' => strip_tags($this->input->post('tingkat_pt',TRUE)),
                'prodi' => strip_tags($this->input->post('prodi',TRUE)),
                'th_lulus' => strip_tags($this->input->post('th_lulus',TRUE)),
                'status' => strip_tags($this->input->post('status',TRUE)),
                'email' => strip_tags($this->input->post('email',TRUE)),
                'statusguru' => strip_tags($this->input->post('statusguru',TRUE))
            ];
            $this->db->update('tb_guru',$data, ['id'=>$id]);
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-guru', 'DATA BERHASIL DIUPDATE');
                redirect('backend/guru');
            }else
            {
                $this->session->set_flashdata('msg-gagal-guru', 'DATA GAGAL DIUPDATE!');
            }
        }
    }

    function hapus_guru($id)
    {
		$get = $this->db->select('id,gambar')->from('tb_guru')->where('id',$id)->get()->row();
        $target = "assets/img/guru/$get->gambar";
		unlink($target);
		$this->db->delete('tb_guru', ['id'=>$id]);
        if($this->db->affected_rows() > 0)
        {
			$this->session->set_flashdata('msg-guru', 'DATA BERHASIL DIHAPUS');
        }else
        {
			$this->session->set_flashdata('msg-gagal-guru', 'DATA GAGAL DIHAPUS!');
        }
        redirect('backend/guru');
    }
 
}