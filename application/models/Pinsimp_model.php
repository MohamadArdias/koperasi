<?php

class Pinsimp_model extends  CI_Model
{
    public function getSukarela()
    {
        $tahun = date("Y");
        $bulan = date("m");

        $query = $this->db->query("SELECT
        *
    FROM
        instan
        INNER JOIN
        anggota
        ON 
            instan.KODE_INS = anggota.KODE_INS
        INNER JOIN
        pinsimp
        ON 
            anggota.KODE_ANG = pinsimp.KODE_ANG
    WHERE
        pinsimp.TAHUN = $tahun AND
        pinsimp.BULAN = '$bulan'
        ORDER BY
        instan.KODE_INS ASC, 
	    anggota.KODE_ANG ASC")->result_array();

        return $query;
    }

    public function cek($thn, $bln, $kode)
    {
        $query = $this->db->query("SELECT
        *
    FROM
        pinsimp
        INNER JOIN
        pl
        ON 
            pinsimp.KODE_ANG = pl.KODE_ANG AND
            pinsimp.BULAN = pl.BULAN AND
            pinsimp.TAHUN = pl.TAHUN
    WHERE
        pinsimp.TAHUN = $thn AND
        pinsimp.BULAN = '$bln' AND
        pinsimp.KODE_ANG = '$kode'");
        return $query->num_rows();
    }

    public function getAllSimp($THN, $BLN)
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        // $bln = date('m');
        // $thn = date('Y');

        $que = $this->db->query("SELECT
        *
    FROM
        anggota
        INNER JOIN
        pl
        ON 
            anggota.KODE_ANG = pl.KODE_ANG
        INNER JOIN
        pinsimp
        ON 
            pl.KODE_ANG = pinsimp.KODE_ANG
    WHERE
        pl.TAHUN = $THN AND
        pl.BULAN = $BLN AND
        pinsimp.TAHUN = $THN AND
        pinsimp.BULAN = $BLN AND
        anggota.KODE_INS != 99 AND
        anggota.KODE_INS != 98 AND
        anggota.KODE_INS != 97 AND
        anggota.KODE_INS != 96 AND
	    anggota.KODE_ANG NOT LIKE '%A%'");

        return $que->result_array();
    }

    public function simp($THN, $BLN)
    {
        // $bln = date('m');
        // $thn = date('Y');

        $que = $this->db->query("SELECT
        *
    FROM
        pl
        INNER JOIN
        anggota
        ON 
            pl.KODE_ANG = anggota.KODE_ANG
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
    WHERE
        pl.TAHUN = $THN AND
        pl.BULAN = $BLN AND
        instan.KODE_INS != 99 AND
        instan.KODE_INS != 98 AND
        instan.KODE_INS != 97 AND
        instan.KODE_INS != 96
    ORDER BY
        instan.KODE_INS ASC");
        return $que->result_array();
    }

    public function getAllSimp2()
    {
        $this->db->select_sum('POPU1');
        $this->db->from('pl');
        $this->db->where('TAHUN', 2022);
        $this->db->where('BULAN', 01);
        $this->db->where('KODE_INS !=', 99);
        $this->db->where('KODE_INS !=', 98);
        $this->db->where('KODE_INS !=', 97);
        $this->db->where('KODE_INS !=', 96);
        return $this->db->get()->result();
    }

    public function getTabungan($THN, $BLN)
    {
        $this->db->select('*');
        $this->db->from('pinsimp');
        $this->db->join('pl', 'pl.KODE_ANG = pinsimp.KODE_ANG');
        $this->db->join('anggota', 'anggota.KODE_ANG = pinsimp.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        // $this->db->where('pinsimp.TAHUN', date('Y', strtotime('-1 month')));
        // $this->db->where('pinsimp.BULAN', date('m', strtotime('-1 month')));
        // $this->db->where('pl.TAHUN', date('Y'));
        // $this->db->where('pl.BULAN', date('m'));
        $this->db->where('pinsimp.TAHUN', $THN);
        $this->db->where('pinsimp.BULAN', $BLN);
        $this->db->where('pl.TAHUN', $THN);
        $this->db->where('pl.BULAN', $BLN);
        $this->db->where('instan.KODE_INS !=', 99);
        $this->db->where('instan.KODE_INS !=', 98);
        $this->db->where('instan.KODE_INS !=', 97);
        $this->db->where('instan.KODE_INS !=', 96);
        $this->db->order_by('instan.KODE_INS', 'ASC');
        // $this->db->where('instan.KODE_INS', "06");
        return $this->db->get()->result_array();
    }

    public function pinsimpAnggota()
    {
        $DATE = $this->input->post('TGLM_ANG');
        $THN = substr($DATE, 0, 4);
        $BLN = substr($DATE, -5, 2);

        $this->data = [
            "TAHUN" => $THN,
            "BULAN" => $BLN,
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "TOTWJB" => 0,
            "TOTPOK" => 0,
            "TOTREL" => 0,
            "GOL" => 'KPRI',
        ];
        $this->db->insert('pinsimp', $this->data);
    }
}
