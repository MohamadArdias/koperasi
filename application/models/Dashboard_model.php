<?php

class Dashboard_model extends CI_Model
{
    // public function getThnById($TAHUN){
    // $this->db->select('*');
    // $this->db->from('pl');
    // $this->db->where('TAHUN',$TAHUN);
    // return $this->db->get()->result_array();
    // }
    public function getBunga()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1', 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row();
        // $this->db->select_sum('SIPOKU3');
        // return  $this->db->get('pl')->num_rows();
    }
    public function getAnggotaTunggak()
    {
        $thn = date('Y');
        // $bln = date('m');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '08');
        $this->db->where('SIPOKU3 !=', 'NULL');
        $this->db->where('KODE_INS !=', '99');
        return $this->db->get('pl')->result_array();
    }
}
