<?php

class Pay_model extends CI_Model
{
    public function getKodeAnggota()
    {
        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->where('KODE_INS', '53');
        return $this->db->get()->result_array();
    }
}
