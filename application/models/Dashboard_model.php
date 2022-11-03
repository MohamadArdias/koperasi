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
        // $this->db->where('BULAN', $bln);
        $this->db->where('SIPOKU3 !=', 'NULL');
        return $this->db->get('pl')->result_array();
    }


    // SP

    public function SPjanuari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPfebruari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '02');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPmaret()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '03');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPapril()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '04');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPmei()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '05');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPjuni()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '06');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPjuli()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '07');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPagustus()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '08');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }


    // Konsumsi Pokok

    
}
