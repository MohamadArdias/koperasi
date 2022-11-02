<?php

class Dashboard_model extends CI_Model
{
    public function getBunga()
    {
        $this->db->select_sum('SIPOKU3');
        return  $this->db->get('pl')->num_rows();
    }
    public function getAnggotaTunggak($table)
    {
        $thn = date('Y');
        $bln = date('m');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', $bln);
        $this->db->where('SIPOKU3 !=', 'NULL');
        return $this->db->get('pl')->result_array();
    }
}
