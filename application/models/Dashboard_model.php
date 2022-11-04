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


    // SP / UANG

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

    public function SPseptember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '09');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPoktober()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '10');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }
    
    public function SPnovember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '11');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function SPdesember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '12');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU1' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }


    // Konsumsi

    public function kjanuari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kfebruari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '02');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kmaret()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '03');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kapril()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '04');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kmei()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '05');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kjuni()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '06');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }
    
    public function Kjuli()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '07');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kagustus()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '08');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kseptember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '09');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Koktober()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '10');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Knovember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '11');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Kdesember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '12');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU2' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    // NON KONSUMSI

    public function Nkjanuari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkfebruari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '02');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkmaret()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '03');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkapril()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '04');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkmei()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '05');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkjuni()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '06');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkjuli()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '07');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkagustus()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '08');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkseptember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '09');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkoktober()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '10');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nknovember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '11');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function Nkdesember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '12');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU3' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    // PINJAMAN KHUSUS

    public function PKjanuari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '01');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKfebruari()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '02');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKmaret()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '03');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKapril()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '04');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKmei()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '05');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKjuni()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '06');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKjuli()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '07');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKagustus()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '08');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKseptember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '09');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKoktober()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '10');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKnovember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '11');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

    public function PKdesember()
    {
        $thn = date('Y');
        $this->db->where('TAHUN', $thn);
        $this->db->where('BULAN', '12');
        $this->db->where('KODE_INS !=', '99');
        $this->db->select_sum('POKU7' , 'jumlah');
        $this->db->from('pl');
        return $this->db->get('')->row(); 
    }

}
