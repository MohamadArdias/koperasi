<?php

class Pinsimp_model extends  CI_Model
{
    public function getAllSimp()
    {
        $bln = date('m', strtotime('-1 month'));
        $thn = date('Y', strtotime('-1 month'));

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinsimp', 'pinsimp.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinsimp.KODE_ANG', 'left');
        $this->db->where('anggota.KODE_INS !=', 99);
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinsimp.TAHUN', $thn);
        $this->db->where('pinsimp.BULAN', $bln);
        $this->db->where('anggota.KODE_INS', 06);
        // $this->db->where('pl.KODE_ANG', '1541');

        return $this->db->get()->result_array();
    }

    public function getAllSimp2()
    {
        $this->db->select_sum('POPU1');
        $this->db->from('pl');
        $this->db->where('TAHUN', 2022);
        $this->db->where('BULAN', 01);
        $this->db->where('KODE_INS !=', 99);
        return $this->db->get()->result();
    }
}
