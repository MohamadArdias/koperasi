<?php

class Pay_model extends CI_Model
{
    public function getKodeAnggota($a)
    {
        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->join('pembayaran', 'pembayaran.KODE_ANG = anggota.KODE_ANG');
        // $this->db->like('TGL_TGHN', date('Y-m', strtotime('-1 month')));
        $this->db->like('TGL_TGHN', date('Y-m'));
        $this->db->where('pembayaran.KODE_ANG', $a);
        return $this->db->get()->row_array();
    }
}
