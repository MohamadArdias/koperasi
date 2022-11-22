<?php

class Pinsimp_model extends  CI_Model
{
    public function getAllSimp()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        // $bln = date('m');
        // $thn = date('Y');

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('anggota.KODE_INS !=', 99);
        $this->db->where('pl.TAHUN', date('Y', strtotime('+1 month')));
        $this->db->where('pl.BULAN', date('m', strtotime('+1 month')));
        // $this->db->where('pinsimp.TAHUN', date('Y'));
        // $this->db->where('pinsimp.BULAN', date('m'));
        // $this->db->where('anggota.KODE_INS', '06');
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

    public function getTabungan()
    {
        $this->db->select('*');
        $this->db->from('pinsimp');
        $this->db->join('pl', 'pl.KODE_ANG = pinsimp.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinsimp.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('pinsimp.TAHUN', date('Y'));
        $this->db->where('pinsimp.BULAN', date('m'));
        $this->db->where('pl.TAHUN', date('Y'));
        $this->db->where('pl.BULAN', date('m'));
        $this->db->where('instan.KODE_INS !=', 99);
        // $this->db->where('instan.KODE_INS', "06");
        return $this->db->get()->result_array();
    }

    public function pinsimpAnggota()
    {
        $this->data = [            
            "TAHUN" => date('Y'),
            "BULAN" => date('m'),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),            
            "TOTWJB" => 0,
            "TOTPOK" => 0,
            "TOTREL" => 0,
            "GOL" => 'KPRI',
        ];
        $this->db->insert('pinsimp', $this->data);
    }
}
