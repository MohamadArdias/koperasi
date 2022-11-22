<?php

class Dashboard_model extends CI_Model
{
    public function getTotalTunggak()
    {
        $thn = date('Y');
        $bln = date('m');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', $bln);
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('TUNGGAKAN', 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row();
    }
    public function getAnggotaTunggak()
    {
        $thn = date('Y');
        $bln = date('m');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', $bln);
        $this->db->where('TUNGGAKAN !=', 'NULL');
        $this->db->where('KODE_INS !=', '99');
        return $this->db->get('pl')->result_array();
    }
}
