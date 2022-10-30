<?php
class Kirim_model extends CI_model
{
    public function getAllKirim()
    {
        $this->db->select('*');
        // $this->db->select("instan.NAMA_INS AS NAMA_INS");
        $this->db->from('pl');
        $this->db->join('instan', 'instan.KODE_INS = pl.KODE_INS');
        $this->db->where('pl.KODE_INS !=', '99');
        $this->db->where('TAHUN', '2022'); //untuk sementara (date("Y"))
        $this->db->where('BULAN', '10'); //untuk sementara (date("m"))
        return  $this->db->get()->result_array();
    }

    public function cariDataKirim()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('NAMA_ANG', $keyword);
        $this->db->or_like('KODE_ANG', $keyword);
        $this->db->or_like('KODE_INS', $keyword);
        $this->db->or_like('NAMA_INS', $keyword);
        return $this->db->get('keuangan')->result_array();
    }

    public function cariDataInstansi()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('KODE_INS', $keyword);
        $this->db->or_like('NAMA_INS', $keyword);
        return $this->db->get('instan')->result_array();
    }
}
