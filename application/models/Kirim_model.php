<?php
class Kirim_model extends CI_model
{
    public function getAllKirim()
    {
        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->where('KODE_INS !=', '99');
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
}
