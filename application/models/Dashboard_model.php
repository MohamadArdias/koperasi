<?php

class Dashboard_model extends CI_Model
{
    public function getBunga()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row();
        // $this->db->select_sum('SIPOKU3');
        // return  $this->db->get('pl')->num_rows();
    } 
    public function getAnggotaTunggak($table)
    {
        $thn = date('Y');
        // $bln = date('m');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '10');
        $this->db->where('SIPOKU3 !=', 'NULL');
        $this->db->where('KODE_INS', '03');
        return $this->db->get('pl')->result_array();
    }
}