<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Album_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function tampil_album()
    {
        return $this->db->select('*')->from('tb_album')->order_by('id_album','desc')->get();
    }

    function tambah_album()
	{
        $data_insert = [
            'album' => strip_tags($this->input->post('album',TRUE)),
            'slug' => slug(strip_tags($this->input->post('album',TRUE))),
            'is_active' => strip_tags($this->input->post('is_active',TRUE)),
            'tgl' => tgl_jam_simpan_sekarang()
        ];

        $this->db->insert('tb_album',$data_insert);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-album', 'ALBUM BERHASIL DITAMBAHKAN');
            redirect('backend/album');
        }else
        {
            $this->session->set_flashdata('msg-gagal-album', 'ALBUM GAGAL DITAMBAHKAN!');
        }
    }

    function cek_album($id)
    {
        return $this->db->select('id_album')->from('tb_album')->where('id_album',$id)->get()->row();
    }

    function edit_album($id)
	{
        $data_update = [
            'album' => strip_tags($this->input->post('album',TRUE)),
            'slug' => slug(strip_tags($this->input->post('album',TRUE))),
            'is_active' => strip_tags($this->input->post('is_active',TRUE)),
            'tgl' => tgl_jam_simpan_sekarang()
        ];

        $this->db->update('tb_album',$data_update,['id_album'=>$id]);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('msg-album', 'ALBUM BERHASIL DIUPDATE');
            redirect('backend/album');
        }else
        {
            $this->session->set_flashdata('msg-gagal-album', 'ALBUM GAGAL DIUPDATE!');
        }
    }

    function hapus_album($id)
	{
        $jml = $this->db->get_where('tb_foto', ['id_album'=>$id])->num_rows();
        if($jml > 0)
        {
            $this->session->set_flashdata('msg-gagal-album', 'ALBUM GAGAL DIHAPUS');
        }else
        {
            $this->db->delete('tb_album', array('id_album'=>$id));
            if($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('msg-album', 'ALBUM BERHASIL DIHAPUS');
            }else
            {
                $this->session->set_flashdata('msg-gagal-album', 'ALBUM GAGAL DIHAPUS!');
            }
        }
        redirect('backend/album');
    }
 
}