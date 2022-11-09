<?php

class Pay_model extends CI_Model
{
    public function getKodeAnggota()
    {
        $bln = date('m', strtotime('-1 month'));
        $thn = date('Y', strtotime('-1 month'));

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', $bln);
        $this->db->where('KODE_INS', '53');
        return $this->db->get()->result_array();
    }
}
