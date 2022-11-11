<?php

class Pembayaran_model extends  CI_Model
{
    public function getPembayaran()
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('anggota', 'anggota.URUT_ANG = pembayaran.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', '99');
        $this->db->order_by('instan.KODE_INS ASC, anggota.URUT_ANG ASC');
        return $this->db->get()->result_array();
    }
}
